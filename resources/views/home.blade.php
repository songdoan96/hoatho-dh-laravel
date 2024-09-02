@extends('layouts.app')
@section('content')
    <div class="h-screen w-full ">
        <div class="flex flex-col gap-4 p-4 items-center justify-center">
            <img src="{{ asset('images/logo2.png') }}" alt="" width="500">
            <a href="{{ route('produce.dashboard') }}"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 ">Thông
                tin sản xuất</a>

            <a href="{{ route('simple.index') }}"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 ">May
                mẫu</a>
            <a href="{{ route('welcome') }}"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 ">Chào
                mừng & lịch làm việc</a>
        </div>

    </div>
@endsection
