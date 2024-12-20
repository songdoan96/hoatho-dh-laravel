@extends('layouts.cutting')

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@endpush

@section('header-title', 'THEO DÕI BTP CHO TỪNG CHUYỀN NGÀY ' . date('d-m-Y'))


@section('content')
    @if (count($plans))
        <div class="min-h-screen flex flex-col">
            <div class="absolute right-2 top-2 flex items-center gap-4">
                <a href="{{ route('cutting.exportFileBtpDayWithDate') }}">
                    <img class="w-8" src="{{ asset('images/file.png') }}" alt="">
                </a>
                <a href="{{ route('produce.finish') }}" title="Đơn hàng đã xuất">
                    <img class="w-8" src="{{ asset('images/history.png') }}" alt="Báo cáo cuối ngày">
                </a>
            </div>
            <div class="p-4">
                <div class="grid grid-cols-2 md:grid-cols-6 gap-4">
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
                            class="bg-white border border-black font-semibold text-gray-100 flex flex-col gap-1 overflow-hidden hover:scale-105 transition rounded">
                            <div class="flex gap-1 font-bold">
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
                                    <span>{{ formatNumber($slkh) ?? 0 }} </span>
                                </div>

                                <div class="flex justify-between">
                                    <span>LK cắt</span>
                                    <span>{{ formatNumber($slcat) }} </span>
                                </div>
                                <div class="flex justify-between">
                                    <span>SL chưa cắt</span>
                                    <span>{{ formatNumber($slkh - $slcat) }} </span>
                                </div>


                                <div class="flex justify-between">
                                    <span>LK cấp</span>
                                    <span>{{ formatNumber($slcap) }} </span>
                                </div>
                                <div class="flex justify-between">
                                    <span>SL chưa cấp</span>
                                    <span>{{ formatNumber($slcat - $slcap) }} </span>
                                </div>
                                <div class="flex justify-between">
                                    <span>Vốn</span>
                                    @isset($von)
                                        <span>{{ formatNumber($von, 1) }} </span>
                                    @else
                                        --
                                    @endisset

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

                            </div>
                        </a>
                    @endforeach
                </div>

            </div>
        </div>
    @endif
@endsection
