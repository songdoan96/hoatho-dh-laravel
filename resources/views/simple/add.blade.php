@extends('layouts.app')
@section('content')
    <div class="min-h-screen flex flex-col bg-primary text-textColor">
        <div id="header" class="flex items-center px-2 py-1 bg-blue-500 text-white">
            <a href="{{ route('simple.dashboard') }}">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-10">
            </a>
            <h1 class="text-center text-2xl uppercase font-bold w-full">Thêm kế hoạch may mẫu</h1>
        </div>
        <div id="form" class="">
            <form method="POST" action="{{ route('simple.store') }}"
                class="mx-auto shadow-lg p-4 grid grid-cols-2 md:grid-cols-5 gap-2">
                @csrf
                <div class="mb-1">
                    <label for="khachhang" class="block mb-2 text-sm font-medium text-white">Khách hàng</label>
                    <input type="text" id="khachhang" name="khachhang" required
                        class="border text-sm rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500" />
                </div>
                <div class="mb-1">
                    <label for="mahang" class="block mb-2 text-sm font-medium text-white">Mã hàng</label>
                    <input type="text" id="mahang" name="mahang" required
                        class="border text-sm rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500" />
                </div>
                <div class="mb-1">
                    <label for="loaimau" class="block mb-2 text-sm font-medium text-white">Loại mẫu</label>
                    <input type="text" id="loaimau" name="loaimau"
                        class="border text-sm rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500" />
                </div>
                <div class="mb-1">
                    <label for="color" class="block mb-2 text-sm font-medium text-white">Màu</label>
                    <input type="text" name="color"
                        class="border text-sm rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500" />
                </div>
                <div class="mb-1">
                    <label for="size" class="block mb-2 text-sm font-medium text-white">Size</label>
                    <input type="text" name="size"
                        class="border text-sm rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500" />
                </div>
                <div class="mb-1">
                    <label for="soluong" class="block mb-2 text-sm font-medium text-white">Số lượng</label>
                    <input type="number" min="1" name="soluong" value="1"
                        class="border text-sm rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500" />
                </div>

                <div class="mb-1">
                    <label for="npl" class="block mb-2 text-sm font-medium text-white">Ngày nhận NPL</label>
                    <input type="date" name="npl"
                        class="border text-sm rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500" />
                </div>
                <div class="mb-1">
                    <label for="rap" class="block mb-2 text-sm font-medium text-white">Ngày nhận rập</label>
                    <input type="date" name="rap"
                        class="border text-sm rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500" />
                </div>
                <div class="mb-1">
                    <label for="tailieu" class="block mb-2 text-sm font-medium text-white">Ngày nhận tài liệu</label>
                    <input type="date" name="tailieu"
                        class="border text-sm rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500" />
                </div>
                <div class="mb-1">
                    <label for="maugoc" class="block mb-2 text-sm font-medium text-white">Ngày nhận mẫu gốc</label>
                    <input type="date" name="maugoc"
                        class="border text-sm rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500" />
                </div>
                <div class="mb-1">
                    <label for="ktmay" class="block mb-2 text-sm font-medium text-white">Kỹ thuật may</label>
                    <input type="text" name="ktmay"
                        class="border text-sm rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500" />
                </div>
                <div class="mb-1">
                    <label for="kcs" class="block mb-2 text-sm font-medium text-white">KC kiểm</label>
                    <input type="text" name="kcs"
                        class="border text-sm rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500" />
                </div>
                <div class="mb-1">
                    <label for="ngaymay" class="block mb-2 text-sm font-medium text-white">Ngày may</label>
                    <input type="date" name="ngaymay"
                        class="border text-sm rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500" />
                </div>
                <div class="mb-1">
                    <label for="ngayhen" class="block mb-2 text-sm font-medium text-white">Ngày hẹn</label>
                    <input type="date" name="ngayhen"
                        class="border text-sm rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500" />
                </div>
                <div class="mb-1">
                    <label for="ngaygui" class="block mb-2 text-sm font-medium text-white">Ngày gửi mẫu</label>
                    <input type="date" name="ngaygui"
                        class="border text-sm rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500" />
                </div>


                <div class="mb-1">
                    <label for="tinhtrang" class="block mb-2 text-sm font-medium text-white">Tình trạng mẫu</label>
                    <select name="tinhtrang"
                        class="border text-sm rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="">--Tình trạng--</option>
                        <option value="dangmay">Đang may</option>
                        <option value="dagui">Đã gửi</option>
                    </select>

                </div>
                <div class="mb-1">
                    <label for="ketqua" class="block mb-2 text-sm font-medium text-white">Kết quả</label>
                    <select name="ketqua"
                        class="border text-sm rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="">--Kết quả--</option>
                        <option value="failed">Failed</option>
                        <option value="passed">Passed</option>
                    </select>

                </div>
                <div class="mb-1">
                    <label for="tuan" class="block mb-2 text-sm font-medium text-white">Tuần</label>
                    <input type="text" name="tuan" minlength="7" maxlength="8"
                        placeholder="vd: T1-8-24, T2-12-24,..."
                        class="border text-sm rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500" />
                </div>
                <div class="mb-1">
                    <label for="ghichu" class="block mb-2 text-sm font-medium text-white">Ghi chú</label>
                    <input type="text" name="ghichu"
                        class="border text-sm rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500" />
                </div>
                <div class="mb-1">
                    <label for="bienban" class="block mb-2 text-sm font-medium text-white">Biên bản</label>
                    <select name="bienban"
                        class="border text-sm rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="">--Kết quả--</option>
                        <option value="0">Chưa có</option>
                        <option value="1">Đã có</option>
                    </select>
                </div>

                <div class="flex justify-start items-end mb-1">
                    <a href="{{ route('simple.dashboard') }}"
                        class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800 mr-2">Hủy</a>
                    <button type="submit" id="simple-add-btn"
                        class="text-white bg-white-700 bg-blue-500 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center flex">
                        Thêm
                    </button>
                </div>

        </div>
    </div>
@endsection
