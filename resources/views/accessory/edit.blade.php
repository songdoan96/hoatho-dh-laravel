@extends('layouts.app')
@section('title', 'NHẬP KHO PHỤ LIỆU')

@section('content')
    <div class="min-h-screen flex flex-col bg-gray-100 text-black">
        <div id="header" class="flex items-center px-2 py-1 bg-blue-500 text-white">
            <a href="{{ route('accessory.dashboard') }}">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-10">
            </a>
            <h1 class="text-center text-2xl uppercase font-bold w-full">Chỉnh sửa MÃ HÀNG
                #{{ $accessory->mahang }} - LOẠI
                {{ $accessory->loai }}</h1>
        </div>
        <div id="form" class="w-full p-2 md:w-2/3 mx-auto">

            <form method="POST" action="{{ route('accessory.update', $accessory) }}" enctype="multipart/form-data"
                class="uppercase mx-auto text-black bg-gray-200 shadow-lg p-4 grid grid-cols-2 md:grid-cols-3 gap-2">
                @csrf
                <div class="mb-1">
                    <label for="khachhang" class="block mb-2 text-sm font-medium">Khách hàng</label>
                    <input type="text" id="khachhang" name="khachhang"
                        value="{{ isset($accessory) ? $accessory->khachhang : '' }}" required
                        class="border text-sm rounded-lg block w-full p-2.5 bg-white" />
                </div>
                <div class="mb-1">
                    <label for="mahang" class="block mb-2 text-sm font-medium">Mã hàng</label>
                    <input type="text" id="mahang" name="mahang"
                        value="{{ isset($accessory) ? $accessory->mahang : '' }}" required
                        class="border text-sm rounded-lg block w-full p-2.5 bg-white" />
                </div>
                <div class="mb-1">
                    <label for="loai" class="block mb-2 text-sm font-medium">Loại PL</label>
                    <input type="text" id="loai" name="loai" required
                        value="{{ isset($accessory) ? $accessory->loai : '' }}"
                        class="border text-sm rounded-lg block w-full p-2.5 bg-white" />
                </div>
                <div class="mb-1">
                    <label for="day" class="block mb-2 text-sm font-medium">Dãy</label>
                    <select id="day" name="day" required
                        class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="">Chọn dãy</option>
                        <option {{ $accessory->day == '01' ? 'selected' : '' }} value="01">01</option>
                        <option {{ $accessory->day == '02' ? 'selected' : '' }} value="02">02</option>
                        <option {{ $accessory->day == '03' ? 'selected' : '' }} value="03">03</option>
                        <option {{ $accessory->day == '04' ? 'selected' : '' }} value="04">04</option>
                        <option {{ $accessory->day == '05' ? 'selected' : '' }} value="05">05</option>
                        <option {{ $accessory->day == '06' ? 'selected' : '' }} value="06">06</option>
                        <option {{ $accessory->day == '07' ? 'selected' : '' }} value="07">07</option>
                        <option {{ $accessory->day == '08' ? 'selected' : '' }} value="08">08</option>
                        <option {{ $accessory->day == '09' ? 'selected' : '' }} value="09">09</option>
                        <option {{ $accessory->day == '10' ? 'selected' : '' }} value="10">10</option>
                        <option {{ $accessory->day == '11' ? 'selected' : '' }} value="11">11</option>
                        <option {{ $accessory->day == '12' ? 'selected' : '' }} value="12">12</option>
                    </select>

                </div>

                <div class="mb-1">
                    <label for="mau" class="block mb-2 text-sm font-medium">Màu</label>
                    <input type="text" id="mau" name="mau"
                        value="{{ isset($accessory) ? $accessory->mau : '' }}"
                        class="border text-sm rounded-lg block w-full p-2.5 bg-white" />
                </div>
                <div class="mb-1">
                    <label for="size" class="block mb-2 text-sm font-medium">Size</label>
                    <input type="text" id="size" name="size"
                        value="{{ isset($accessory) ? $accessory->size : '' }}"
                        class="border text-sm rounded-lg block w-full p-2.5 bg-white" />
                </div>
                <div class="mb-1">
                    <label for="donvi" class="block mb-2 text-sm font-medium">Đơn vị</label>
                    <input type="text" id="donvi" name="donvi" required
                        value="{{ isset($accessory) ? $accessory->donvi : '' }}"
                        class="border text-sm rounded-lg block w-full p-2.5 bg-white" />
                </div>
                <div class="mb-1">
                    <label for="po" class="block mb-2 text-sm font-medium">PO</label>
                    <input type="text" id="po" name="po"
                        value="{{ isset($accessory) ? $accessory->po : '' }}"
                        class="border text-sm rounded-lg block w-full p-2.5 bg-white" />
                </div>
                <div class="mb-1">
                    <label for="soluong" class="block mb-2 text-sm font-medium">Số lượng</label>
                    <input type="number" step="any" min="0" id="soluong" name="soluong" required
                        value="{{ isset($accessory) ? $accessory->soluong : '' }}"
                        class="border text-sm rounded-lg block w-full p-2.5 bg-white" />
                </div>
                <div class="mb-1">
                    <label for="ngay" class="block mb-2 text-sm font-medium">Ngày nhập</label>
                    <input type="date" id="ngay" name="ngay" required max="{{ date('Y-m-d') }}"
                        value="{{ isset($accessory) ? $accessory->ngay : '' }}"
                        class="border text-sm rounded-lg block w-full p-2.5 bg-white" />
                </div>
                <div class="mb-1">
                    <label for="ghichu" class="block mb-2 text-sm font-medium">Ghi chú</label>
                    <input type="text" id="ghichu" name="ghichu"
                        class="border text-sm rounded-lg block w-full p-2.5 bg-white" />
                </div>

                <div class="flex justify-start items-end mb-1">
                    <a href="{{ route('accessory.dashboard') }}"
                        class="min-w-24 block text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center mr-2">Hủy</a>
                    <button type="submit" id="simple-add-btn"
                        class="min-w-24 text-white bg-white-700 bg-blue-500 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center flex">
                        Cập nhật
                    </button>
                </div>
        </div>
    </div>
@endsection
