@extends('layouts.app')
@section('content')
    <div class="h-screen w-full ">
        <div class="flex justify-center items-center w-full">
            <img src="{{ asset('images/logo2.png') }}" alt="Logo" width="500">
        </div>
        <div class="grid grid-cols-4 p-8 gap-8">
            <a href="{{ route('produce.dashboard') }}"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 ">Thông
                tin sản xuất</a>
            <a href="{{ route('simple.index') }}"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 ">May
                mẫu</a>
            <a href="{{ route('internal.document') }}"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 ">Tài
                liệu nội bộ</a>
            <a href="{{ route('accessory.dashboard') }}"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 ">Phụ
                liệu</a>
            <a href="{{ route('welcome') }}"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 ">Chào
                mừng & lịch làm việc</a>
        </div>

    </div>
@endsection
