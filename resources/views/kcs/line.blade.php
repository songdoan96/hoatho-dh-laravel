@extends('layouts.app')
@push('meta')
    <meta http-equiv="refresh" content="120">
@endpush
@section('content')
    <div class="bg-black text-white h-screen w-screen">
        @if($plan && $kcs)
            <div class="h-screen w-screen overflow-hidden bg-blue-900 text-white text-xl uppercase flex flex-col">
                <div class="h-[100px] flex border-b-2">
                    <div class="w-3/12 h-full left flex justify-between items-center p-2 border-r-2">
                        <div class="image">
                            <img src="{{asset('images/logo.png')}}" alt="" width="50px">
                        </div>
                        <div class="flex flex-col">
                            <p>xn1</p>
                            <p>Tổ 6 </p>
                        </div>
                    </div>
                    <div class="center flex-1 h-full p-2 flex items-center justify-between font-extrabold">
                        <span class="text-center w-1/2">
                            <p class="text-3xl">ĐỊNH MỨC NGÀY</p>
                            <p class="text-5xl">{{$kcs->chitieungay}}</p>
                        </span>
                        <span class="text-center w-1/2">
                            <p class="text-3xl">ĐỊNH MỨC H.TẠI</p>
                            <p class="text-5xl">id-{{$plan->id}}</p>
                        </span>
                    </div>
                    <div class="w-3/12 h-full left flex justify-between items-center p-2 border-l-2">
                        <div class="flex flex-col">
                            <p>xn1</p>
                            <p>Tổ 6 </p>
                        </div>
                        <div class="image">
                            <img src="{{asset('images/logo.png')}}" alt="" width="50px">
                        </div>
                    </div>
                </div>
                <div class="flex-1 p-1 text-3xl leading-none font-extrabold grid grid-cols-4 gap-1">
                    <div class="border-2 text-center flex flex-col items-center gap-2 p-2">
                        <span>SỐ LƯỢNG ĐẠT</span>
                        <span class="text-8xl">100</span>
                    </div>
                    <div class="border-2 text-center flex flex-col items-center gap-2 p-2">
                        <span>TỶ LỆ ĐẠT</span>
                        <span class="text-8xl">100</span>
                    </div>
                    <div class="border-2 text-center flex flex-col items-center gap-2 p-2">
                        <span>SỐ LƯỢNG LỖI</span>
                        <span class="text-8xl">100</span>
                    </div>
                    <div class="border-2 text-center flex flex-col items-center gap-2 p-2">
                        <span>TỶ LỆ LỖI</span>
                        <span class="text-8xl">100</span>
                    </div>
                    <div class="border-2 text-center flex flex-col items-center gap-2 p-2">
                        <span>TÁC NGHIỆP</span>
                        <span class="text-8xl">100</span>
                    </div>
                    <div class="border-2 text-center flex flex-col items-center gap-2 p-2">
                        <span>ĐÃ THỰC HIỆN</span>
                        <span class="text-8xl">100</span>
                    </div>
                    <div class="border-2 text-center flex flex-col items-center gap-2 p-2">
                        <span>BTP CẤP</span>
                        <span class="text-8xl">100</span>
                    </div>
                    <div class="border-2 text-center flex flex-col items-center gap-2 p-2">
                        <span>VỐN</span>
                        <span class="text-8xl">100</span>
                    </div>
                    <div class="border-2 text-center flex flex-col items-center gap-2 p-2">
                        <span>NHẬP KHO</span>
                        <span class="text-8xl">100</span>
                    </div>
                    <div class="border-2 text-center flex flex-col items-center gap-2 p-2">
                        <span>NHẬP THIẾU</span>
                        <span class="text-8xl">100</span>
                    </div>
                    <div
                        class="border-2 text-center flex flex-col items-center gap-2 p-2 col-span-2">
                        <span>3 lỗi cao nhất</span>
                        <span class="text-base text-left w-full px-4">
                          <p>1. sườn tay sụp mí </p>
                          <p>2.sườn tay đứt chỉ</p>
                          <p>3.quay cổ kẹp</p>
                        </span>
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
