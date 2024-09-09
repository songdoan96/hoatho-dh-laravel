@extends('layouts.app')
@section('title', 'Năng suất ' . ($plan->chuyen ?? ''))

@push('meta')
    <meta http-equiv="refresh" content="120">
@endpush
@push('styles')
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
        }

        .number {
            font-weight: 900;
            font-size: 5rem;
            color: #00ff00;
        }

        .red {
            color: red
        }

        .yellow {
            color: yellow;
        }
    </style>
@endpush
@section('content')
    <div class="bg-black text-white h-screen w-screen">
        @if ($plan)
            <div class=" flex flex-col h-screen w-screen overflow-hidden bg-black text-white text-4xl font-bold uppercase">
                <div class="bg-blue-900 flex items-center h-24 text-2xl">
                    <div class="w-1/6 flex flex-col justify-between h-full py-2 px-1">
                        <p>
                            <span class="yellow font-bold">Date:</span>
                            <span>{{ date('d-m-Y') }}</span>
                        </p>
                        <p>
                            <span class="yellow font-bold">Time:</span>
                            <span id="time"></span>
                        </p>
                    </div>
                    <div class="flex-1 h-full py-2 flex text-4xl border-x-2">
                        <div class="w-1/2 px-4 flex">
                            <div class="flex flex-col justify-between w-2/3">
                                @php
                                    $chuyen = explode('_', $plan->chuyen);
                                @endphp
                                <p>May Đông Hà</p>
                                <p>{{ $chuyen[0] . '-Tổ ' . $chuyen[1] }}</p>
                            </div>
                            <div class="flex items-center justify-center flex-1">
                                <a href="{{ route('produce.dashboard') }}" class="h-full">
                                    <img src="{{ asset('images/logo.png') }}" alt="Logo"
                                        class="bg-cover object-cover h-full">
                                </a>
                            </div>
                        </div>
                        <div class="w-1/2 px-4 flex">
                            <div class="flex items-center justify-center flex-1">
                                @if ($plan->logo)
                                    <img src="{{ asset('storage/' . $plan->logo) }}" alt="Logo" class="bg-cover h-full">
                                @endif
                            </div>
                            <div class="flex flex-col justify-between w-2/3 items-end">
                                <a href="{{ route('plan.editLogo', $plan) }}">
                                    <p>{{ $plan->khachhang }}</p>
                                </a>
                                <a href="{{ route('plan.editLogo', $plan) }}">
                                    <p>{{ $plan->mahang }}</p>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="w-1/6 flex flex-col justify-between h-full py-2 px-2">
                        @isset($kcs)
                            <a href="{{ route('kcs.editWorker', $kcs) }}">
                                <span class="yellow font-bold">Lao động:</span>
                                <span>{{ $kcs->laodong }}</span>
                            </a>
                            <a href="{{ route('kcs.editWorker', $kcs) }}">
                                <span class="yellow font-bold">Dự phòng:</span>
                                <span>{{ $kcs->duphong }}</span>
                            </a>
                            </a>
                        @else
                            <span class="yellow">LĐ: --</span>
                            <span class="yellow">DP: --</span>
                        @endisset


                    </div>
                </div>
                <div class="flex h-48">
                    <div class="flex flex-1 text-center py-2">
                        <div class="w-1/4 flex flex-col">
                            <p class="yellow">Tác nghiệp</p>
                            <p class="text-2xl">Order qty</p>
                            <p class="text-5xl font-bold mt-4">
                                <a href="{{ route('plan.editPlan', $plan) }}">
                                    {{ number_format($plan->sltacnghiep, 0, ',', ' ') }}
                                </a>

                            </p>
                        </div>
                        <div class="w-1/4 flex flex-col">
                            <p class="yellow">Thực hiện</p>
                            <p class="text-2xl">Finished</p>
                            <p class="text-5xl font-bold mt-4">
                                <a href="{{ route('plan.editPlan', $plan) }}">
                                    {{ number_format($plan->thuchien, 0, ',', ' ') }}

                                </a>
                            </p>
                        </div>
                        <div class="w-1/4 flex flex-col">
                            <p class="yellow">Nhập kho</p>
                            <p class="text-2xl">Stored</p>
                            <p class="text-5xl font-bold mt-4">
                                <a href="{{ route('plan.editPlan', $plan) }}">
                                    {{ number_format($plan->nhaphoanthanh, 0, ',', ' ') }}

                                </a>
                            </p>
                        </div>
                        <div class="w-1/4 flex flex-col">
                            <p class="yellow">Nhập thiếu</p>
                            <p class="text-2xl">remaining qty</p>
                            <p class="text-5xl font-bold mt-4">
                                <a href="{{ route('plan.editPlan', $plan) }}">
                                    {{ number_format($plan->thuchien - $plan->nhaphoanthanh, 0, ',', ' ') }}
                                </a>
                            </p>
                        </div>
                    </div>
                    <div class="w-4/12 p-2">
                        <p class="text-left text-3xl mb-2 red">3 lỗi cao nhất / Top 3 errors</p>
                        @if (count($errors) > 0 && $errors[0] != '')
                            <span class="text-xl text-left w-full">
                                @foreach ($errors as $index => $error)
                                    <p class="line-clamp-1">{{ $index + 1 }}. {{ $error }}</p>
                                @endforeach
                            </span>
                        @endif
                    </div>
                </div>
                <div class="flex-1 grid grid-cols-2 grid-rows-4 gap-8 pb-2">
                    <div class="flex items-center">
                        <div class="flex flex-col justify-between w-1/2">
                            <p class="yellow">BTP CẤP</p>
                            <p>semi-finished</p>
                        </div>
                        <p class="number flex-1 text-right">
                            <a href="{{ route('produce.editBtp', $plan) }}">
                                {{ number_format($plan->btpcap, 0, ',', ' ') }}
                            </a>
                        </p>
                    </div>
                    <div class="flex items-center">
                        <div class="flex flex-col justify-between w-1/2">
                            <p class="yellow">TỶ LỆ vỐN</p>
                            <p>Remaining rate</p>
                        </div>
                        <p class="number flex-1 text-right">
                            <a href="{{ route('produce.editBtp', $plan) }}"
                                class="@if (isset($von) && $von > $plan->mucvon) animate-blink red @endif">
                                {{ isset($von) ? round($von, 1) : '--' }}
                            </a>
                        </p>
                    </div>
                    <div class="flex items-center">
                        <div class="flex flex-col justify-between w-1/2">
                            <p class="yellow">Chỉ tiêu/Ngày</p>
                            <p>Target/day</p>
                        </div>
                        <p class="number flex-1 text-right">
                            @isset($kcs)
                                <a href="{{ route('kcs.editWorker', $kcs) }}">{{ $kcs->chitieungay }}</a>
                            @else
                                --
                            @endisset
                        </p>
                    </div>
                    <div class="flex items-center">
                        <div class="flex flex-col justify-between w-1/2">
                            <p class="yellow">Chỉ tiêu hiện tại</p>
                            <p>Target now</p>
                        </div>
                        <p class="number flex-1 text-right">{{ $dmhientai ?? 0 }}</p>
                    </div>
                    <div class="flex items-center">
                        <div class="flex flex-col justify-between w-1/2">
                            <p class="yellow">Sản phẩm đạt</p>
                            <p>Pass product</p>
                        </div>
                        <p class="number flex-1 text-right">{{ $kcs->sldat ?? '--' }}</p>
                    </div>
                    <div class="flex items-center">
                        <div class="flex flex-col justify-between w-1/2">
                            <p class="yellow">Tỷ lệ đạt</p>
                            <p>Achieve rate</p>
                        </div>
                        <p class="number flex-1 text-right">
                            @isset($tyleloi)
                                {{ round($tyledat, 1) }}<span class="text-5xl">%</span>
                            @else
                                --
                            @endisset
                        </p>
                    </div>
                    <div class="flex items-center">
                        <div class="flex flex-col justify-between w-1/2">
                            <p class="yellow">Sản phẩm lỗi</p>
                            <p>Defect product</p>
                        </div>
                        <p class="number flex-1 text-right red">{{ $kcs->slloi ?? '--' }}</p>
                    </div>
                    <div class="flex items-center">
                        <div class="flex flex-col justify-between w-1/2">
                            <p class="yellow">Tỷ lệ lỗi</p>
                            <p>Defect rate</p>
                        </div>
                        <p class="number flex-1 text-right red">
                            @isset($tyleloi)
                                {{ round($tyleloi, 1) }}<span class="text-5xl">%</span>
                            @else
                                --
                            @endisset
                        </p>
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
            document.getElementById("time").innerText = `${h}:${m}:${s}`;
        }
        setInterval(() => {
            getTime();
        }, 1000);
    </script>
@endpush
