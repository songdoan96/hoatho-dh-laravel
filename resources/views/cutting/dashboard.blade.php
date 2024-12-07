@extends('layouts.app')

@push('meta')
    <meta http-equiv="refresh" content="3600">
@endpush

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@endpush



@section('content')
    <div class="min-h-screen flex flex-col">
        <div id="header" class="flex items-center px-2 py-1 bg-blue-500 text-white">
            <a href="{{ route('produce.dashboard') }}" class="w-10">
                <img src="{{ asset('images/logo.png') }}" alt="Logo">
            </a>
            <div class="flex items-center gap-4 flex-1 justify-center">
                <h1 class="text-center text-2xl uppercase font-bold">THEO DÕI BTP CHO TỪNG CHUYỀN NGÀY
                    {{ date('d-m-Y') }}</h1>
            </div>
        </div>

        @if (count($plans))
            <div class="p-4">
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    @foreach ($plans as $plan)
                        <a href="{{ route('cutting.editBtp', $plan) }}"
                            class="bg-white border border-black font-semibold text-gray-100 text-lg flex flex-col gap-1 overflow-hidden hover:scale-105 transition rounded">
                            <div class="flex gap-1 text-xl font-bold">
                                <div class="w-1/2 bg-blue-600 flex items-center justify-center">
                                    <p class="text-3xl">{{ $plan->chuyen }}</p>
                                </div>
                                <div class="w-1/2 bg-blue-600 flex flex-col items-center">
                                    <p class="line-clamp-1">{{ $plan->khachhang }}</p>
                                    <p class="line-clamp-1">{{ $plan->mahang }}</p>
                                </div>
                            </div>
                            <div class="bg-blue-100 p-2 flex flex-col text-black">
                                <div class="flex justify-between">
                                    <span>Tác nghiệp</span>
                                    <span>{{ formatNumber($plan->sltacnghiep) }} </span>
                                </div>
                                @php
                                    $slcap = $plan->btp_day->sum('slcap');
                                    $slcat = $plan->btp_day->sum('slcat');
                                    $lkcapPercent = round(($slcap / $plan->sltacnghiep) * 100, 1);
                                    $lkcatPercent = round(($slcat / $plan->sltacnghiep) * 100, 1);
                                @endphp
                                <div class="flex justify-between">
                                    <span>LK cắt</span>
                                    <span>{{ formatNumber($slcat) }} </span>
                                </div>
                                <div class="flex justify-between">
                                    <span>SL chưa cắt</span>
                                    <span>{{ formatNumber($plan->sltacnghiep - $slcat) }} </span>
                                </div>

                                <div class="flex justify-between items-center gap-1 mt-2 hidden">
                                    <span class="bg-gray-100 h-3 w-full relative overflow-hidden">
                                        <span class="absolute h-full left-0 bg-[#7cd79f]"
                                            style="width: {{ $lkcatPercent }}%"></span>
                                        <span
                                            class="text-blue-900 absolute w-full h-full text-xs font-bold flex justify-center items-center">{{ $lkcatPercent }}
                                            %</span>
                                    </span>
                                </div>
                                <div class="flex justify-between">
                                    <span>LK cấp</span>
                                    <span>{{ formatNumber($slcap) }} </span>
                                </div>
                                <div class="flex justify-between">
                                    <span>SL chưa cấp</span>
                                    <span>{{ formatNumber($slcat - $slcap) }} </span>
                                </div>

                                <div class="flex justify-between items-center gap-1 mt-2 hidden">

                                    <span class="bg-gray-100 h-3 w-full relative overflow-hidden">
                                        <span class="absolute h-full left-0 bg-[#7cd79f]"
                                            style="width: {{ $lkcapPercent }}%"></span>
                                        <span
                                            class="text-blue-900 absolute w-full h-full text-xs font-bold flex justify-center items-center">{{ $lkcapPercent }}
                                            %</span>
                                    </span>
                                </div>

                                @php

                                    $subDate = \Carbon\Carbon::today()->subDays(5);
                                    $btpsDay = $plan->btp_day->where('ngay', '>=', $subDate);
                                    $btpsDayData = [];
                                    foreach ($btpsDay as $key => $btpDay) {
                                        if (in_array($btpDay->ngay, array_keys($btpsDayData))) {
                                            $btpsDayData[(string) $btpDay->ngay] = [
                                                $btpsDayData[(string) $btpDay->ngay][0] + $btpDay->slcat,
                                                $btpsDayData[(string) $btpDay->ngay][1] + $btpDay->slcap,
                                            ];
                                        } else {
                                            $btpsDayData[(string) $btpDay->ngay] = [$btpDay->slcat, $btpDay->slcap];
                                        }
                                    }
                                @endphp
                                <canvas id="myChart-{{ $plan->id }}"></canvas>
                                <script>
                                    document.addEventListener('DOMContentLoaded', function() {
                                        const btpsDay = {!! json_encode($btpsDayData) !!};
                                        if (Object.keys(btpsDay).length) {
                                            let labels = [];
                                            let dataValues = [];
                                            let dataValues1 = [];
                                            Object.entries(btpsDay).forEach((day, index) => {
                                                const [year, month, date] = day[0].split("-");
                                                const result = `${date}/${month}`;
                                                labels.push(result);
                                                dataValues.push(day[1][0]);
                                                dataValues1.push(day[1][1]);
                                            });

                                            const data = {
                                                labels: labels,
                                                datasets: [{
                                                    label: 'BTP cắt',
                                                    data: dataValues,
                                                    fill: false,
                                                    borderColor: '#7CD79F',
                                                    backgroundColor: '#7CD79F',
                                                    tension: 0.1
                                                }, {
                                                    label: 'BTP cấp',
                                                    data: dataValues1,
                                                    fill: false,
                                                    borderColor: '#FF6384',
                                                    backgroundColor: '#FF6384',
                                                    tension: 0.1
                                                }]
                                            };
                                            const config = {
                                                type: 'bar',
                                                data: data,
                                            };
                                            const ctx = document.getElementById("myChart-" + {{ $plan->id }});
                                            new Chart(ctx, config);
                                        }

                                    });
                                </script>
                            </div>
                        </a>
                    @endforeach
                </div>

            </div>
        @endif


    </div>
@endsection
