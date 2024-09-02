@extends('layouts.app')
@push('meta')
    <meta http-equiv="refresh" content="120">
@endpush
@section('content')
    <div class="min-h-screen flex flex-col">
        <div id="header" class="flex items-center px-2 py-1 bg-blue-500 text-white">
            <a href="{{ route('produce.dashboard') }}" class="w-10">
                <img src="{{ asset('images/logo.png') }}" alt="Logo">
            </a>
            <div class="flex items-center gap-4 flex-1 justify-center">
                <h1 class="text-center text-2xl uppercase font-bold">THEO DÕI SẢN XUẤT</h1>
                <a href="{{ route('kcs.dashboard') }}" title="Báo cáo cuối ngày">
                    <img src="{{ asset('images/report.gif') }}" alt="Báo cáo cuối ngày" width="40">
                </a>
                <a href="{{ route('plan.dashboard') }}" title="Đơn hàng tiếp theo" class="rounded-full overflow-hidden">
                    <img src="{{ asset('images/next.gif') }}" alt="Báo cáo cuối ngày" width="40">
                </a>
                <a href="{{ route('produce.finish') }}" title="Đơn hàng đã xuất">
                    <img src="{{ asset('images/history.png') }}" alt="Báo cáo cuối ngày" width="40">
                </a>
            </div>
        </div>

        @if (count($plans))
            <div class="p-4">
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    @foreach ($plans as $plan)
                        <a href="{{ route('kcs.line', $plan->chuyen) }}"
                            class="bg-white border border-black font-semibold text-gray-100 text-lg flex flex-col gap-1 overflow-hidden hover:scale-105 transition">
                            <div class="flex gap-1 text-xl font-bold">
                                <div class="w-1/2 bg-blue-600 flex items-center justify-center">
                                    <p class="text-3xl">{{ $plan->chuyen }}</p>
                                </div>
                                <div class="w-1/2 bg-blue-600 flex flex-col items-center">
                                    <p class="line-clamp-1">{{ $plan->khachhang }}</p>
                                    <p class="line-clamp-1">{{ $plan->mahang }}</p>
                                </div>
                            </div>
                            <div class="bg-blue-600 p-2 flex flex-col">
                                <div class="flex justify-between">
                                    <span>Tác nghiệp</span>
                                    <span>{{ formatNumber($plan->sltacnghiep) }} <span class="text-sm">pcs</span></span>
                                </div>
                                @php
                                    $thuchienPercent = round(($plan->thuchien / $plan->sltacnghiep) * 100, 1);
                                @endphp
                                <div class="flex justify-between">
                                    <span>LK thực hiện</span>
                                    <span class="flex items-center gap-1">
                                        <span>{{ formatNumber($plan->thuchien) }}<span class="text-sm"> pcs</span>
                                            @if ($thuchienPercent > 95)
                                                <form action="{{ route('plan.planDone', $plan) }}" method="post"
                                                    class="inline-flex items-center justify-center">
                                                    @csrf
                                                    <button onclick="return confirm('Xác nhận kết thúc đơn hàng này?')"
                                                        class="inline-flex items-center justify-center"><img
                                                            src="{{ asset('images/alert.gif') }}" width="20"
                                                            alt="Sắp hết đơn hàng"></button>
                                                </form>
                                            @endif
                                        </span>
                                    </span>
                                </div>
                                <div class="flex justify-between items-center gap-1 mt-2">

                                    <span class="bg-gray-100 h-3 w-full relative overflow-hidden">
                                        <span class="absolute h-full left-0 bg-[#7cd79f]"
                                            style="width: {{ $thuchienPercent }}%"></span>
                                        <span
                                            class="text-blue-900 absolute w-full h-full text-xs font-bold flex justify-center items-center">{{ $thuchienPercent }}
                                            %</span>
                                    </span>
                                </div>
                                <div class="flex justify-between">
                                    <span>SL còn lại</span>
                                    <span>{{ formatNumber($plan->sltacnghiep - $plan->thuchien) }} <span
                                            class="text-sm">pcs</span></span>
                                </div>

                                <div class="flex justify-between">
                                    <span>Nhập hoàn thành</span>
                                    <span>{{ formatNumber($plan->nhaphoanthanh) }} <span class="text-sm">pcs</span></span>
                                </div>


                            </div>
                            @php
                                $kcs = $plan->kcs->where('ngaytao', date('Y-m-d'))->first();
                            @endphp
                            <div class="bg-blue-600 p-2">
                                <div class="flex justify-between">
                                    <span>Chỉ tiêu ngày</span>
                                    <span>{{ $kcs->chitieungay ?? '--' }} <span class="text-sm">pcs</span></span>
                                </div>

                                <div class="flex justify-between">
                                    <span>SP đạt / TL đạt</span>
                                    <span>{{ $kcs->sldat ?? '--' }} <span class="text-sm">pcs</span> /
                                        {{ $kcs ? round(($kcs->sldat / $kcs->chitieungay) * 100, 2) : '--' }} %</span>
                                </div>
                                <div class="flex justify-between">
                                    <span>SP lỗi / TL lỗi</span>
                                    @php
                                        $loiPercent = null;
                                        if (isset($kcs)) {
                                            if ($kcs->sldat == 0 && $kcs->slloi == 0) {
                                                $loiPercent = 0;
                                            } else {
                                                $loiPercent = round(
                                                    ($kcs->slloi / ($kcs->sldat + $kcs->slloi)) * 100,
                                                    2,
                                                );
                                            }
                                        }
                                    @endphp
                                    <span>{{ $kcs->slloi ?? '--' }} <span class="text-sm">pcs</span> /
                                        {{ $loiPercent ?? '--' }}
                                        %</span>
                                </div>

                            </div>
                        </a>
                    @endforeach
                    @if (count($plansWaiting))
                        <div
                            class="bg-blue-600 p-2 border border-black text-gray-100 flex flex-col gap-1 overflow-hidden transition">
                            <h2 class="text-center uppercase text-lg font-bold">Đơn hàng chờ sản xuất</h2>
                            @foreach ($plansWaiting as $index => $plw)
                                <p>- {{ $plw->chuyen }}:{{ $plw->mahang }}(
                                    {{ formatDate($plw->ngaydukien, 'd-m') }} )
                                </p>
                            @endforeach
                        </div>
                    @endif

                </div>

            </div>
        @endif


    </div>
@endsection
