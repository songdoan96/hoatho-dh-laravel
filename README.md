control.php: lay ke hoach co thuc hien < kehoach

--Backup 2 database

--Redirect
---- http://localhost/hoathodh/sanxuatdh/index.php :
header("Location: http://localhost:8000/sanxuat") ;

--- http://localhost/hoathodh/kcs/dailyreport.php
--- http://localhost/hoathodh/kcs/control.php
header("Location: http://localhost:8000/kcs");

---- http://localhost/hoathodh/sanxuatdh/history.php
header("Location: http://localhost:8000/sanxuat/ket-thuc");

---- http://localhost/hoathodh/sanxuatdh/waiting.php
header("Location: http://localhost:8000/kehoach");

---- http://localhost/hoathodh/sanxuatdh/lineinfo.php?chuyen=01
header("Location: http://localhost:8000/kcs/XN1_02");

if (strlen($chuyen) == 2) {
header("Location: http://localhost:8000/kcs/XN1_$chuyen");
} else {
$chuyenX2 = explode(".", $chuyen);
$new = $chuyenX2[1];
header("Location: http://localhost:8000/kcs/XN2_$new");
}

<!-- *
@extends('layouts.app')
@push('meta')
    <meta http-equiv="refresh" content="15">
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
            @php
                $chuyen = explode('_', $plan->chuyen);
            @endphp
            <div class="h-full w-full overflow-hidden bg-blue-800 text-white text-xl uppercase flex flex-col gap-1">
                <div class="h-[150px] flex border-b-2">
                    <div class="w-1/4 h-full left flex flex-col justify-between items-center p-2 border-r-2 border-l-2">
                        <div class="flex h-2/3 w-full justify-between items-center font-extrabold text-5xl">
                            <a href="{{ route('produce.dashboard') }}">
                                <img src="{{ asset('images/logo.png') }}" alt="" width="70px">
                            </a>
                            <p>{{ $plan->chuyen }}</p>
                        </div>
                        <div class="flex h-1/3 w-full justify-between items-center font-extrabold text-4xl">
                            @isset($kcs)
                                <a href="{{ route('kcs.editWorker', $kcs) }}">LĐ: {{ $kcs->laodong }}</a>
                                <a href="{{ route('kcs.editWorker', $kcs) }}">DP: {{ $kcs->duphong }}</a>
                            @else
                                <span>LĐ: --</span>
                                <span>DP: --</span>
                            @endisset

                        </div>
                    </div>
                    <div class="center flex-1 h-full p-2 flex font-extrabold">
                        <span class="text-center w-1/2">
                            <p class="text-3xl">ĐỊNH MỨC NGÀY</p>
                            <p class="text-9xl number">
                                @isset($kcs)
                                    <a href="{{ route('kcs.editWorker', $kcs) }}">{{ $kcs->chitieungay }}</a>
                                @else
                                    --
                                @endisset
                            </p>
                        </span>
                        <span class="text-center w-1/2">
                            <p class="text-3xl">ĐỊNH MỨC H.TẠI</p>
                            <p class="text-9xl number">{{ $dmhientai ?? 0 }}</p>
                        </span>
                    </div>
                    <div class="w-1/4 h-full left flex justify-between items-center p-2 border-l-2 border-r-2">
                        <div class="flex flex-col h-full justify-between font-extrabold text-4xl">
                            <p>{{ $plan->khachhang }}</p>
                            <p>{{ $plan->mahang }}</p>
                        </div>
                        <div class="image">
                            @if ($plan->logo)
                                <img src="{{ $plan->logo }}" alt="" width="70px">
                            @else
                                <div class="bg-gray-400 h-20 w-20"></div>
                            @endif

                        </div>
                    </div>
                </div>
                <div class="h-[calc(100vh-150px)] text-4xl leading-none font-extrabold grid grid-cols-4 gap-1">
                    <div class="border-2 text-center flex flex-col items-center gap-2 p-2">
                        <span>SỐ LƯỢNG ĐẠT</span>
                        <span class="text-9xl number">{{ $kcs->sldat ?? '--' }}</span>
                    </div>
                    <div class="border-2 text-center flex flex-col items-center gap-2 p-2">
                        <span>TỶ LỆ ĐẠT</span>
                        <span class="text-9xl number tracking-wider">
                            @isset($tyleloi)
                                {{ round($tyledat, 1) }}<span class="text-5xl">%</span>
                            @else
                                --
                            @endisset
                        </span>
                    </div>
                    <div class="border-2 text-center flex flex-col items-center gap-2 p-2">
                        <span>SỐ LƯỢNG LỖI</span>
                        <span class="text-9xl number">{{ $kcs->slloi ?? '--' }}</span>
                    </div>
                    <div class="border-2 text-center flex flex-col items-center gap-2 p-2">
                        <span>TỶ LỆ LỖI</span>
                        <span class="text-9xl number tracking-wider">
                            @isset($tyleloi)
                                {{ round($tyleloi, 1) }}<span class="text-5xl">%</span>
                            @else
                                --
                            @endisset
                        </span>
                    </div>
                    <div class="border-2 text-center flex flex-col items-center gap-2 p-2">
                        <span>TÁC NGHIỆP</span>
                        <a href="{{ route('produce.editWarehouseUpdate', $plan) }}" class="text-9xl number">
                            {{ $plan->sltacnghiep }}
                        </a>
                    </div>
                    <div class="border-2 text-center flex flex-col items-center gap-2 p-2">
                        <span>ĐÃ THỰC HIỆN</span>
                        <a href="{{ route('produce.editWarehouseUpdate', $plan) }}" class="text-9xl number">
                            {{ $plan->thuchien }}
                        </a>
                    </div>
                    <div class="border-2 text-center flex flex-col items-center gap-2 p-2">
                        <span>BTP CẤP</span>
                        <span class="text-9xl number">{{ $plan->btpcap }}</span>
                    </div>
                    <div class="border-2 text-center flex flex-col items-center gap-2 p-2">
                        <span>VỐN</span>
                        <span class="text-9xl number tracking-wider">{{ isset($von) ? round($von, 1) : '--' }}</span>
                    </div>
                    <div class="border-2 text-center flex flex-col items-center gap-2 p-2">
                        <span>NHẬP KHO</span>
                        <a href="{{ route('produce.editWarehouseUpdate', $plan) }}" class="text-9xl number">
                            {{ $plan->nhaphoanthanh }}
                        </a>
                    </div>
                    <div class="border-2 text-center flex flex-col items-center gap-2 p-2">
                        <span>NHẬP THIẾU</span>
                        <a href="{{ route('produce.editWarehouseUpdate', $plan) }}" class="text-9xl number">
                            {{ $plan->thuchien - $plan->nhaphoanthanh }}
                        </a>
                    </div>
                    <div class="border-2 text-center flex flex-col items-center gap-2 p-2 col-span-2">
                        <span>3 lỗi cao nhất</span>
                        @if (count($errors) > 0 && $errors[0] != '')
                            <span class="text-xl text-left w-full px-4">
                                @foreach ($errors as $index => $error)
                                    <p>{{ $index + 1 }}. {{ $error }}</p>
                                @endforeach
                            </span>
                        @endif
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

* -->
