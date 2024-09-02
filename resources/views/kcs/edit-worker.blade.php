@extends('layouts.app')
@section('content')
    <div class="min-h-screen flex flex-col">
        <div id="header" class="flex items-center px-2 py-1 bg-blue-500 text-white">
            <a href="{{ route('produce.dashboard') }}" class="w-10">
                <img src="{{ asset('images/logo.png') }}" alt="Logo">
            </a>
            <div class="flex items-center gap-4 flex-1 justify-center">
                <h1 class="text-center text-2xl uppercase font-bold">CẬP NHẬT THÔNG TIN LAO ĐỘNG - CHỈ TIÊU
                    {{ $kcs->plans->chuyen }}</h1>
            </div>
        </div>
        <div class="mx-auto w-full md:w-5/12 ">
            <div class="w-full text-xl text-black bg-gray-300 py-2 px-6 uppercase">
                <div class="flex"><span class="w-2/5 font-semibold">Khách hàng:
                    </span><span>{{ $kcs->plans->khachhang }}</span>
                </div>
                <div class="flex"><span class="w-2/5 font-semibold">Mã hàng: </span><span>{{ $kcs->plans->mahang }}</span>
                </div>
                <div class="flex"><span class="w-2/5 font-semibold">LK tác nghiệp:
                    </span><span>{{ $kcs->plans->sltacnghiep }}</span></div>
                <div class="flex"><span class="w-2/5 font-semibold">LK thực hiện:
                    </span><span>{{ $kcs->plans->thuchien }}</span></div>
            </div>
            <form method="POST" action="{{ route('kcs.updateWorker', $kcs) }}" class="p-4 border">
                @csrf
                <div class="my-5 flex items-center gap-8">
                    <label for="laodong" class="font-medium w-1/3">LAO ĐỘNG</label>
                    <input type="number" id="laodong" name="laodong" value="{{ $kcs->laodong }}" min="1" required
                        class="flex-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5" />
                </div>
                <div class="my-5 flex items-center gap-8">
                    <label for="duphong" class="font-medium w-1/3">DỰ PHÒNG</label>
                    <input type="number" id="duphong" name="duphong" value="{{ $kcs->duphong }}" min="0" required
                        class="flex-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5" />
                </div>
                <div class="my-5 flex items-center gap-8">
                    <label for="chitieungay" class="font-medium w-1/3">CHỈ TIÊU NGÀY</label>
                    <input type="number" id="chitieungay" name="chitieungay" value="{{ $kcs->chitieungay }}"
                        min="1" required
                        class="flex-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5" />
                </div>
                <div class="flex justify-center gap-2">
                    <a href="javascript:history.back()"
                        class="text-white bg-red-700 hover:bg-red-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center ">
                        HỦY
                    </a>
                    <button type="submit"
                        class="text-white bg-blue-700 hover:bg-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center ">
                        CẬP NHẬT
                    </button>
                </div>
            </form>

        </div>
    </div>
@endsection
