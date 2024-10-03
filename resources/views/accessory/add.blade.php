@extends('layouts.accessory')
@section('title', 'NHẬP KHO PHỤ LIỆU')
@section('header-title', 'NHẬP KHO')
@section('content')

    <div id="form" class="w-full p-2 md:w-2/3 mx-auto">
        <div class="bg-white flex justify-between mb-2 px-4 py-2">
            <div class="flex gap-2 items-end mb-2">
                <img src="{{ asset('images/download.png') }}" alt="Download" width="40">
                <a class="underline" href="{{ route('accessory.downloadFile') }}">
                    Tải file mẫu
                </a>
            </div>
            <form action="{{ route('accessory.upload') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="file" name="file" id="file" required
                    class="text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                <button type="submit" id="accessory-upload-btn"
                    class="text-white bg-white-700 bg-blue-500 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                    Tải lên
                </button>
            </form>
        </div>
        <form method="POST" action="{{ route('accessory.store') }}" enctype="multipart/form-data"
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
                    <option value="A">A</option>
                    <option value="B">B</option>
                    <option value="C">C</option>
                    <option value="D">D</option>
                    <option value="E">E</option>
                    <option value="F">F</option>
                    <option value="G">G</option>
                    <option value="H">H</option>
                    <option value="I">I</option>
                    <option value="K">K</option>
                    <option value="L">L</option>
                </select>

            </div>

            <div class="mb-1">
                <label for="mau" class="block mb-2 text-sm font-medium">Màu</label>
                <input type="text" id="mau" name="mau" value="{{ isset($accessory) ? $accessory->mau : '' }}"
                    class="border text-sm rounded-lg block w-full p-2.5 bg-white" />
            </div>
            <div class="mb-1">
                <label for="size" class="block mb-2 text-sm font-medium">Size</label>
                <input type="text" id="size" name="size" value="{{ isset($accessory) ? $accessory->size : '' }}"
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
                <input type="text" id="po" name="po" value="{{ isset($accessory) ? $accessory->po : '' }}"
                    class="border text-sm rounded-lg block w-full p-2.5 bg-white" />
            </div>
            <div class="mb-1">
                <label for="soluong" class="block mb-2 text-sm font-medium">Số lượng</label>
                <input type="number" step="any" min="0" id="soluong" name="soluong" required
                    class="border text-sm rounded-lg block w-full p-2.5 bg-white" />
            </div>
            <div class="mb-1">
                <label for="ngay" class="block mb-2 text-sm font-medium">Ngày nhập</label>
                <input type="date" id="ngay" name="ngay" required max="{{ date('Y-m-d') }}"
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
                    Nhập kho
                </button>
            </div>
    </div>

@endsection
