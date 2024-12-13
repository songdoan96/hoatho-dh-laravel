@extends('layouts.cutting')

@push('meta')
    <meta http-equiv="refresh" content="2000">
@endpush

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@endpush

@section('header-title', 'THEO DÕI BTP CHO TỪNG CHUYỀN NGÀY ' . date('d-m-Y'))
@push('styles')
    <style>
        #header {
            padding-top: 0;
            padding-bottom: 0;
        }

        #header a img {
            width: 2rem;
        }
    </style>
@endpush

@section('content')
    @if (count($plans))
        <div class="min-h-screen flex flex-col">
            <div class="p-1">
                <div class="grid grid-cols-2 md:grid-cols-6 gap-1">
                    @foreach ($plans as $plan)
                        @php
                            $slkh = $plan->btp->sum('slkh');
                            $slcap = $plan->btp_day->sum('slcap');
                            $slcat = $plan->btp_day->sum('slcat');
                            $lkcapPercent = round(($slcap / $plan->sltacnghiep) * 100, 1);
                            $lkcatPercent = round(($slcat / $plan->sltacnghiep) * 100, 1);
                            $kcs = $plan->kcs->where('ngaytao', date('Y-m-d'))->first();

                            if ($kcs) {
                                if ($plan->chuyen == 11 || $plan->chuyen == 15) {
                                    $von = abs(($plan->btpcap - $plan->nhaphoanthanh) / $kcs->chitieungay);
                                } else {
                                    $von = abs(($slcap - $plan->nhaphoanthanh) / $kcs->chitieungay);
                                }
                            }
                        @endphp
                        <a href="{{ route('cutting.editBtp', $plan) }}"
                            class="bg-white border border-black font-semibold text-gray-100 flex flex-col overflow-hidden hover:scale-105 transition rounded leading-tight">
                            <div class="flex gap-1 font-bold">
                                <div class="w-1/3 bg-sky-600 flex items-center justify-center">
                                    <p class="text-xl">{{ $plan->chuyen }}</p>
                                </div>
                                <div class="w-2/3 bg-sky-600 flex flex-col items-center">
                                    <p class="line-clamp-1">{{ $plan->khachhang }}</p>
                                    <p class="line-clamp-1">{{ $plan->mahang }}</p>
                                </div>
                            </div>
                            <div class="bg-sky-100 p-1 pb-0 flex flex-col text-black">
                                <div class="flex justify-between px-2">
                                    <span>Tác nghiệp</span>
                                    <span>{{ formatNumber($slkh) ?? 0 }} </span>
                                </div>

                                <div class="flex justify-between px-2 text-green-500">
                                    <span>LK cắt</span>
                                    <span>{{ formatNumber($slcat) }} </span>
                                </div>
                                <div class="flex justify-between px-2">
                                    <span>SL chưa cắt</span>
                                    <span>{{ formatNumber($slkh - $slcat) }} </span>
                                </div>


                                <div class="flex justify-between px-2 text-orange-500">
                                    <span>LK cấp</span>
                                    <span>{{ formatNumber($slcap) }} </span>
                                </div>
                                <div class="flex justify-between px-2">
                                    <span>SL chưa cấp</span>
                                    <span>{{ formatNumber($slcat - $slcap) }} </span>
                                </div>
                                <div class="flex justify-between px-2 text-red-500">
                                    <span>Vốn</span>
                                    @isset($von)
                                        <span>{{ formatNumber($von, 1) }} </span>
                                    @else
                                        --
                                    @endisset

                                </div>

                                @php

                                    $subDate = \Carbon\Carbon::today()->subDays(5);
                                    $btpsDay = $plan->btp_day->where('ngay', '>=', $subDate)->sortBy('ngay');
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
                                                    label: 'SL cắt',
                                                    data: dataValues,
                                                    fill: false,
                                                    borderColor: '#22C55E',
                                                    backgroundColor: '#22C55E',
                                                    tension: 0.1
                                                }, {
                                                    label: 'SL cấp',
                                                    data: dataValues1,
                                                    fill: false,
                                                    borderColor: '#F77316',
                                                    backgroundColor: '#F77316',
                                                    tension: 0.1
                                                }]
                                            };
                                            const config = {
                                                type: 'line',
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
        </div>
    @endif
@endsection
