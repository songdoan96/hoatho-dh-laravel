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
            color: blue;
        }

        .red {
            color: red
        }

        .yellow {
            color: yellow;
        }

        .yellow1 {
            /* color: #1E3A8A; */
            color: yellow;
        }


        .bg-yellow {
            background-color: yellow
        }

        .teal {
            color: teal
        }
    </style>
@endpush
@section('content')
    <div class="text-black h-screen w-screen bg-black ">
        @if ($plan)
            <div class=" flex flex-col h-screen w-screen overflow-hidden text-white text-4xl font-bold uppercase">
                <div class="bg-blue-900 flex items-center h-32 text-2xl">
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
                                {{-- @php
                                    $chuyen = explode('_', $plan->chuyen);
                                @endphp --}}
                                <p>May Đông Hà</p>
                                {{-- <p>{{ $chuyen[0] . '-Tổ ' . $chuyen[1] }}</p> --}}
                                <p>Tổ: {{ $plan->chuyen }}</p>
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
                            <a href="{{ route('kcs.editWorker') }}">
                                <span class="yellow font-bold">Lao động:</span>
                                <span>{{ $kcs->laodong }}</span>
                            </a>
                            <a href="{{ route('kcs.editWorker') }}">
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
                <div class="flex flex-row gap-1 mb-2 h-48 text-black">
                    <div class="flex flex-1 text-center py-2 bg-yellow">
                        <div class="w-1/4 flex flex-col">
                            <p class="text-blue-900">Tác nghiệp</p>
                            <p class="text-2xl">Order qty</p>
                            <p class="text-5xl font-bold mt-4">
                                <a class="teal" href="{{ route('plan.editPlan', $plan) }}">
                                    {{ formatNumber($plan->sltacnghiep) }}
                                </a>

                            </p>
                        </div>
                        <div class="w-1/4 flex flex-col">
                            <p class="text-blue-900">Thực hiện</p>
                            <p class="text-2xl">Finished</p>
                            <p class="text-5xl font-bold mt-4">
                                <a class="teal" href="{{ route('plan.editPlan', $plan) }}">
                                    {{ formatNumber($plan->thuchien) }}

                                </a>
                            </p>
                        </div>
                        <div class="w-1/4 flex flex-col">
                            <p class="text-blue-900">Nhập kho</p>
                            <p class="text-2xl">Stored</p>
                            <p class="text-5xl font-bold mt-4">
                                <a class="teal" href="{{ route('plan.editPlan', $plan) }}">
                                    {{ formatNumber($plan->nhaphoanthanh) }}

                                </a>
                            </p>
                        </div>
                        <div class="w-1/4 flex flex-col">
                            <p class="text-blue-900">Nhập thiếu</p>
                            <p class="text-2xl">remaining qty</p>
                            <p class="text-5xl font-bold mt-4">
                                <a class="teal" href="{{ route('plan.editPlan', $plan) }}">
                                    {{ formatNumber($plan->thuchien - $plan->nhaphoanthanh) }}
                                </a>
                            </p>
                        </div>
                    </div>
                    <div class="w-4/12 p-2 bg-yellow">
                        <p class="text-center text-2xl mb-2 red">3 lỗi cao nhất / Top 3 errors</p>
                        @if (count($errors) > 0 && $errors[0] != '')
                            <span class="text-2xl text-left w-full">
                                @foreach ($errors as $index => $error)
                                    @if (strlen($error) && $index < 3)
                                        <p class="line-clamp-1">{{ $index + 1 }}. {{ $error }}</p>
                                    @endif
                                @endforeach
                            </span>
                        @endif
                    </div>
                </div>
                <div class="text-white flex-1 grid grid-cols-1 grid-rows-4 gap-1">
                    <div class="flex border-2 border-black px-2 bg-blue-400">

                        <div class="w-1/2 flex items-center">
                            <div class="flex flex-col justify-between w-1/2">
                                <p class="yellow1">BTP CẤP</p>
                                <p>semi-finished</p>
                            </div>
                            <p class="number flex-1 text-left">
                                @if ($plan->chuyen == 11 || $plan->chuyen == 15)
                                    <a href="{{ route('cutting.editBtp', $plan) }}">
                                        {{ formatNumber($plan->btpcap) }}
                                    </a>
                                @else
                                    <a href="{{ route('cutting.editBtp', $plan) }}">
                                        {{ $plan->btp_day->sum('slcap') }}
                                    </a>
                                @endif
                                {{-- <a href="{{ route('cutting.editBtp', $plan) }}">
                                    {{ formatNumber($plan->btpcap) }}
                                </a> --}}
                                {{-- <a href="{{ route('cutting.editBtp', $plan) }}">
                                    {{ $plan->btp_day->sum('slcap') }}
                                </a> --}}
                            </p>
                        </div>
                        <div class="w-1/2 flex items-center">
                            <div class="flex flex-col justify-between w-1/2">
                                <p class="yellow1">TỶ LỆ vỐN</p>
                                <p>Remaining rate</p>
                            </div>
                            <p class="number flex-1 text-left">
                                <a href="{{ route('cutting.editBtp', $plan) }}"
                                    class="@if (isset($von) && $von > $plan->mucvon) animate-blink red @endif">
                                    {{ isset($von) ? formatNumber($von, 1) : '--' }}
                                </a>
                            </p>
                        </div>
                    </div>
                    <div class="flex border-2 border-black px-2 bg-blue-400">
                        <div class="w-1/2 flex items-center ">
                            <div class="flex flex-col justify-between w-1/2">
                                <p class="yellow1">Chỉ tiêu/Ngày</p>
                                <p>Target/day</p>
                            </div>
                            <p class="number flex-1 text-left">
                                @isset($kcs)
                                    <a href="{{ route('kcs.editWorker') }}">{{ formatNumber($kcs->chitieungay) }}</a>
                                @else
                                    --
                                @endisset
                            </p>
                        </div>
                        <div class="w-1/2 flex items-center ">
                            <div class="flex flex-col justify-between w-1/2">
                                <p class="yellow1">Chỉ tiêu hiện tại</p>
                                <p>Target now</p>
                            </div>
                            <p class="number flex-1 text-left">{{ $dmhientai ?? 0 }}</p>
                        </div>
                    </div>
                    <div class="flex border-2 border-black px-2 bg-[#42d649]">
                        <div class="w-1/2 flex items-center ">
                            <div class="flex flex-col justify-between w-1/2">
                                <p class="yellow1">Sản phẩm đạt</p>
                                <p>Pass product</p>
                            </div>
                            <p class="number flex-1 text-left " style="color: #0e4d09">
                                {{ $kcs->sldat ?? '--' }}</p>
                        </div>
                        <div class="w-1/2 flex items-center ">
                            <div class="flex flex-col justify-between w-1/2">
                                <p class="yellow1">Tỷ lệ đạt</p>
                                <p>Achieve rate</p>
                            </div>
                            <p class="number flex-1 text-left " style="color: #0e4d09">
                                @isset($tyledat)
                                    {{ formatNumber($tyledat, 1) }}<span class="text-5xl " style="color: #0e4d09">%</span>
                                @else
                                    --
                                @endisset
                            </p>
                        </div>
                    </div>
                    <div class="flex border-2 border-black px-2 bg-[#fc8a82]">
                        <div class="w-1/2 flex items-center ">
                            <div class="flex flex-col justify-between w-1/2">
                                <p class="yellow1">Sản phẩm lỗi</p>
                                <p>Defect product</p>
                            </div>
                            <p class="number flex-1 text-left red">{{ $kcs->slloi ?? '--' }}</p>
                        </div>
                        <div class="w-1/2 flex items-center ">
                            <div class="flex flex-col justify-between w-1/2">
                                <p class="yellow1">Tỷ lệ lỗi</p>
                                <p>Defect rate</p>
                            </div>
                            <p class="number flex-1 text-left red">
                                @isset($tyleloi)
                                    {{ formatNumber($tyleloi, 1) }}<span class="text-5xl">%</span>
                                @else
                                    --
                                @endisset
                            </p>
                        </div>
                    </div>

                </div>
            </div>
        @else
            <div class="w-full h-full flex justify-center items-center bg-black text-white">
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
