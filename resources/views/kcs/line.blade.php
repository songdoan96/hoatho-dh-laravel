@extends('layouts.app')
@section('title', 'Năng suất ' . ($plan->chuyen ?? ''))

@push('meta')
    <meta http-equiv="refresh" content="120">
@endpush
@push('styles')
    <style>
        @font-face {
            font-family: '7-Segment';
            src: url('{{ asset('fonts/number.ttf') }}');
        }

        .number {
            font-family: '7-Segment';
            line-height: 1;
            white-space: nowrap;
        }
    </style>
@endpush
@section('content')
    <div class="bg-black text-white h-screen w-screen">
        @if ($plan)
            <div
                class="h-screen w-screen overflow-hidden bg-blue-800 text-white text-4xl font-bold uppercase grid grid-cols-4 grid-rows-4 gap-1">
                <div class="flex border-2 p-2 flex-col justify-between">
                    <div class="flex justify-center items-center">
                        <a href="{{ route('produce.dashboard') }}" class="w-16">
                            <img src="{{ asset('images/logo.png') }}" alt="Logo">
                        </a>
                    </div>
                    <span class="text-6xl text-center">{{ $plan->chuyen }}</span>
                    <div class="flex justify-between items-center font-extrabold">
                        @isset($kcs)
                            <a href="{{ route('kcs.editWorker', $kcs) }}">LĐ: {{ $kcs->laodong }}</a>
                            <a href="{{ route('kcs.editWorker', $kcs) }}">DP: {{ $kcs->duphong }}</a>
                        @else
                            <span>LĐ: --</span>
                            <span>DP: --</span>
                        @endisset
                    </div>
                </div>
                <div class="flex justify-between border-2 col-span-2 p-2">
                    <div class="w-1/2 flex flex-col gap-2 items-center">
                        <p>ĐỊNH MỨC NGÀY</p>
                        <p class="text-9xl number">
                            @isset($kcs)
                                <a href="{{ route('kcs.editWorker', $kcs) }}">{{ $kcs->chitieungay }}</a>
                            @else
                                --
                            @endisset
                        </p>
                    </div>
                    <div class="w-1/2 flex flex-col gap-2 items-center">
                        <p>ĐỊNH MỨC H.TẠI</p>
                        <p class="text-9xl number">{{ $dmhientai ?? 0 }}</p>
                    </div>
                </div>
                <div class="flex flex-col justify-between border-2 p-2">
                    <div class="flex justify-center items-center h-16">
                        @if ($plan->logo)
                            <img src="{{ asset('storage/' . $plan->logo) }}" alt="Logo" class="h-full">
                        @endif
                    </div>
                    <span class="text-center">
                        <a href="{{ route('plan.editLogo', $plan) }}">{{ $plan->khachhang }}</a>
                    </span>
                    <span class="text-center">{{ $plan->mahang }}</span>
                </div>
                <div class="flex flex-col items-center border-2 p-2 gap-2">
                    <p>SỐ LƯỢNG ĐẠT</p>
                    <p class="text-9xl number">{{ $kcs->sldat ?? '--' }}</p>
                </div>
                <div class="flex flex-col items-center border-2 p-2 gap-2">
                    <p>TỶ LỆ ĐẠT</p>
                    <p class="text-9xl number tracking-wider">
                        @isset($tyleloi)
                            {{ round($tyledat, 1) }}<span class="text-5xl">%</span>
                        @else
                            --
                        @endisset
                    </p>
                </div>
                <div class="flex flex-col items-center border-2 p-2 gap-2">
                    <p>SỐ LƯỢNG LỖI</p>
                    <p class="text-9xl number">{{ $kcs->slloi ?? '--' }}</p>
                </div>

                <div class="flex flex-col items-center border-2 p-2 gap-2">
                    <p>TỶ LỆ LỖI</p>
                    <p class="text-9xl number tracking-wider">
                        @isset($tyleloi)
                            {{ round($tyleloi, 1) }}<span class="text-5xl">%</span>
                        @else
                            --
                        @endisset
                    </p>
                </div>
                <div class="flex flex-col justify-between items-center border-2 p-2 gap-2">
                    <p>TÁC NGHIỆP</p>
                    <a href="{{ route('plan.editPlan', $plan) }}" class="text-8xl number">
                        {{ $plan->sltacnghiep }}
                    </a>
                </div>
                <div class="flex flex-col justify-between items-center border-2 p-2 gap-2">
                    <p>ĐÃ THỰC HIỆN</p>
                    <a href="{{ route('plan.editPlan', $plan) }}" class="text-8xl number">
                        {{ $plan->thuchien }}
                    </a>
                </div>
                <div class="flex flex-col justify-between items-center border-2 p-2 gap-2">
                    <p>BTP CẤP</p>
                    <a href="{{ route('produce.editBtp', $plan) }}" class="text-8xl number">
                        {{ $plan->btpcap }}
                    </a>
                </div>
                <div class="flex flex-col justify-between items-center border-2 p-2 gap-2">
                    <p>VỐN</p>
                    <a href="{{ route('produce.editBtp', $plan) }}"
                        class="text-8xl number @if (isset($von) && $von > $plan->mucvon) animate-blink text-red-500 @endif">
                        {{ isset($von) ? round($von, 1) : '--' }}
                    </a>
                </div>
                <div class="flex flex-col justify-between items-center border-2 p-2 gap-2">
                    <p>NHẬP KHO</p>
                    <a href="{{ route('plan.editPlan', $plan) }}" class="text-8xl number">
                        {{ $plan->nhaphoanthanh }}
                    </a>
                </div>
                <div class="flex flex-col justify-between items-center border-2 p-2 gap-2">
                    <p>NHẬP THIẾU</p>
                    <a href="{{ route('plan.editPlan', $plan) }}" class="text-8xl number">
                        {{ $plan->thuchien - $plan->nhaphoanthanh }}
                    </a>
                </div>
                <div class="flex flex-col justify-between border-2 col-span-2">
                    <div class="flex flex-col items-center gap-2 px-2 pt-2">
                        <span>3 lỗi cao nhất</span>
                        @if (count($errors) > 0 && $errors[0] != '')
                            <span class="text-2xl text-left w-full">
                                @foreach ($errors as $index => $error)
                                    <p class="line-clamp-1">{{ $index + 1 }}. {{ $error }}</p>
                                @endforeach
                            </span>
                        @endif
                    </div>
                    <div class="flex justify-between text-xl w-full px-2">
                        <p>Date: {{ date('d-m-Y') }}</p>
                        <p id="time">Time: {{ date('H:i:s') }}</p>
                    </div>
                </div>
            </div>
        @else
            <div class="w-full h-full flex justify-center items-center">
                <h4 class="uppercase text-7xl font-bold">Chưa có thông tin sản xuất</h4>
            </div>
        @endif
    </div>
@endsection
@push('scripts')
    <script>
        function getTime() {
            const now = new Date();
            const h = now.getHours() < 10 ? "0" + now.getHours() : now.getHours();
            const m = now.getMinutes() < 10 ? "0" + now.getMinutes() : now.getMinutes();
            const s = now.getSeconds() < 10 ? "0" + now.getSeconds() : now.getSeconds();
            document.getElementById("time").innerText = "Time: " + `${h}:${m}:${s}`;
        }
        setInterval(() => {
            getTime();
        }, 1000);
    </script>
@endpush
