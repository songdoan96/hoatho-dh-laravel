@extends('layouts.app')
@section('content')
    <div class="min-h-screen flex flex-col bg-gray-100 text-black">
        <div id="header" class="flex items-center px-2 py-1 bg-blue-500 text-white">
            <a href="{{ route('internal.document') }}">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-10">
            </a>
            <h1 class="text-center text-2xl uppercase font-bold w-full">Thêm tài liệu</h1>
        </div>
        <div id="form" class="w-full p-2 md:w-2/3 mx-auto">
            <form method="POST" action="{{ route('internal.documentStore') }}" enctype="multipart/form-data"
                class="mx-auto text-black bg-gray-50 shadow-lg p-4 grid grid-cols-2 md:grid-cols-3 gap-2">
                @csrf
                <div class="mb-1">
                    <label for="bophan" class="block mb-2 text-sm font-medium">Bộ phận</label>
                    <input type="text" id="bophan" name="bophan" required
                        class="border text-sm rounded-lg block w-full p-2.5 bg-gray-200" />
                </div>
                <div class="mb-1">
                    <label for="stt" class="block mb-2 text-sm font-medium">STT bộ phận</label>
                    <input type="text" id="stt" name="stt"
                        class="border text-sm rounded-lg block w-full p-2.5 bg-gray-200" />
                </div>
                <div class="mb-1">
                    <label for="vanbanso" class="block mb-2 text-sm font-medium">Văn bản số</label>
                    <input type="text" id="vanbanso" name="vanbanso"
                        class="border text-sm rounded-lg block w-full p-2.5 bg-gray-200" />
                </div>
                <div class="mb-1">
                    <label for="danhmuc" class="block mb-2 text-sm font-medium">Danh mục</label>
                    <input type="text" id="danhmuc" name="danhmuc"
                        class="border text-sm rounded-lg block w-full p-2.5 bg-gray-200" />
                </div>

                <div class="mb-1">
                    <label for="phanloai" class="block mb-2 text-sm font-medium">Phân loại</label>
                    <input type="text" id="phanloai" name="phanloai"
                        class="border text-sm rounded-lg block w-full p-2.5 bg-gray-200" />
                </div>
                <div class="mb-1">
                    <label for="ngaybanhanh" class="block mb-2 text-sm font-medium">NGÀY BAN HÀNH LẦN ĐẦU</label>
                    <input type="text" id="ngaybanhanh" name="ngaybanhanh"
                        class="border text-sm rounded-lg block w-full p-2.5 bg-gray-200" />
                </div>
                <div class="mb-1">
                    <label for="ngaysuadoi" class="block mb-2 text-sm font-medium">NGÀY SĐ/ CẬP NHẬT</label>
                    <input type="text" id="ngaysuadoi" name="ngaysuadoi"
                        class="border text-sm rounded-lg block w-full p-2.5 bg-gray-200" />
                </div>
                <div class="mb-1">
                    <label for="lansuadoi" class="block mb-2 text-sm font-medium">LẦN SỬA ĐỔI</label>
                    <input type="number" min="0" id="lansuadoi" name="lansuadoi"
                        class="border text-sm rounded-lg block w-full p-2.5 bg-gray-200" />
                </div>
                <div class="mb-1">
                    <label for="thoigianluu" class="block mb-2 text-sm font-medium">THỜI GIAN LƯU TRỮ</label>
                    <input type="text" id="thoigianluu" name="thoigianluu"
                        class="border text-sm rounded-lg block w-full p-2.5 bg-gray-200" />
                </div>
                <div class="mb-1">
                    <label for="noiluutru" class="block mb-2 text-sm font-medium">NƠI LƯU TRỮ HỒ SƠ</label>
                    <input type="text" id="noiluutru" name="noiluutru"
                        class="border text-sm rounded-lg block w-full p-2.5 bg-gray-200" />
                </div>

                <div class="mb-1">
                    <label for="ghichu" class="block mb-2 text-sm font-medium">Ghi chú</label>
                    <input type="text" id="ghichu" name="ghichu"
                        class="border text-sm rounded-lg block w-full p-2.5 bg-gray-200" />
                </div>
                <div class="mb-1">
                    <label for="file" class="block mb-2 text-sm font-medium">File</label>
                    <input type="file" id="file" name="file"
                        class="border text-sm rounded-lg block w-full p-2.5 bg-gray-200" />
                </div>
                <div class="flex justify-start items-end mb-1">
                    <a href="{{ route('internal.document') }}"
                        class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800 mr-2">Hủy</a>
                    <button type="submit" id="simple-add-btn"
                        class="text-white bg-white-700 bg-blue-500 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center flex">
                        Thêm
                    </button>
                </div>
        </div>
    </div>
@endsection
