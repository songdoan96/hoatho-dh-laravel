@extends('layouts.accessory')
@section('title', 'XUẤT KHO PHỤ LIỆU')
@section('header-title', 'XUẤT KHO')

@section('content')

    <div id="form" class="w-full p-2 md:w-2/3 mx-auto">
        <form method="POST" action="{{ route('accessory.orderStore', $accessory->id) }}" enctype="multipart/form-data"
            class="mx-auto text-black bg-gray-100 shadow-lg p-4 grid grid-cols-2 md:grid-cols-3 gap-2">
            @csrf
            <div class="mb-1">
                <label for="khachhang" class="block mb-2 text-sm font-medium">Khách hàng</label>
                <input type="text" id="khachhang" name="khachhang" readonly
                    value="{{ isset($accessory) ? $accessory->khachhang : '' }}" required
                    class="border text-sm rounded-lg block w-full p-2.5 bg-gray-200" />
            </div>
            <div class="mb-1">
                <label for="mahang" class="block mb-2 text-sm font-medium">Mã hàng</label>
                <input type="text" id="mahang" name="mahang" readonly
                    value="{{ isset($accessory) ? $accessory->mahang : '' }}" required
                    class="border text-sm rounded-lg block w-full p-2.5 bg-gray-200" />
            </div>
            <div class="mb-1">
                <label for="loai" class="block mb-2 text-sm font-medium">Loại PL</label>
                <input type="text" id="loai" name="loai" required readonly
                    value="{{ isset($accessory) ? $accessory->loai : '' }}"
                    class="border text-sm rounded-lg block w-full p-2.5 bg-gray-200" />
            </div>
            <div class="mb-1">
                <label for="day" class="block mb-2 text-sm font-medium">Dãy</label>
                <input type="text" id="day" name="day" required readonly
                    value="{{ isset($accessory) ? $accessory->day : '' }}"
                    class="border text-sm rounded-lg block w-full p-2.5 bg-gray-200" />



            </div>

            <div class="mb-1">
                <label for="mau" class="block mb-2 text-sm font-medium">Màu</label>
                <input type="text" id="mau" name="mau" readonly
                    value="{{ isset($accessory) ? $accessory->mau : '' }}"
                    class="border text-sm rounded-lg block w-full p-2.5 bg-gray-200" />
            </div>
            <div class="mb-1">
                <label for="size" class="block mb-2 text-sm font-medium">Size</label>
                <input type="text" id="size" name="size" readonly
                    value="{{ isset($accessory) ? $accessory->size : '' }}"
                    class="border text-sm rounded-lg block w-full p-2.5 bg-gray-200" />
            </div>
            <div class="mb-1">
                <label for="donvi" class="block mb-2 text-sm font-medium">Đơn vị</label>
                <input type="text" id="donvi" name="donvi" required readonly
                    value="{{ isset($accessory) ? $accessory->donvi : '' }}"
                    class="border text-sm rounded-lg block w-full p-2.5 bg-gray-200" />
            </div>
            <div class="mb-1">
                <label for="po" class="block mb-2 text-sm font-medium">PO</label>
                <input type="text" id="po" name="po" readonly
                    value="{{ isset($accessory) ? $accessory->po : '' }}"
                    class="border text-sm rounded-lg block w-full p-2.5 bg-gray-200" />
            </div>
            <div class="mb-1">
                <label for="soluong" class="block mb-2 text-sm font-medium">Số lượng (Tối đa:
                    {{ $accessory->soluong - $totalOrders }})</label>
                <input type="number" step="any" min="0" id="soluong" name="soluong"
                    max="{{ $accessory->soluong - $totalOrders }}" required
                    class="border text-sm rounded-lg block w-full p-2.5 bg-white" />
            </div>
            <div class="mb-1">
                <label for="ngay" class="block mb-2 text-sm font-medium">Ngày xuất</label>
                <input type="date" id="ngay" name="ngay" required max="{{ date('Y-m-d') }}"
                    class="border text-sm rounded-lg block w-full p-2.5 bg-white" />
            </div>
            <div class="mb-1">
                <label for="nguoinhan" class="block mb-2 text-sm font-medium">Người nhận</label>
                <input type="text" id="nguoinhan" name="nguoinhan" required
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
                    Xuất kho
                </button>
            </div>
    </div>
@endsection
