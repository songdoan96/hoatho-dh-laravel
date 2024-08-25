@extends('layouts.app')
@section('content')
    <div class="min-h-screen flex flex-col">
        <div id="header" class="flex items-center px-2 py-1 bg-blue-500 text-white">
            <a href="{{ route('simple.dashboard') }}">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-10">
            </a>
            <h1 class="text-center text-2xl uppercase font-bold w-full">Cập nhật mẫu</h1>
        </div>
        <div class="">
            <form id="form-edit-new" method="POST" action="{{ route('simple.update', ['id' => $simple->id]) }}"
                class="mx-auto shadow-lg p-4 grid grid-cols-2 md:grid-cols-5 gap-2">
                @csrf
                <div class="mb-1">
                    <label for="khachhang" class="block mb-2 text-sm font-medium text-white">Khách hàng</label>
                    <input type="text" id="khachhang" name="khachhang" value="{{ $simple->khachhang }}"
                        class="border text-sm rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500"
                        required />
                </div>
                <div class="mb-1">
                    <label for="mahang" class="block mb-2 text-sm font-medium text-white">Mã hàng</label>
                    <input type="text" id="mahang" name="mahang" value="{{ $simple->mahang }}"
                        class="border text-sm rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500"
                        required />
                </div>
                <div class="mb-1">
                    <label for="loaimau" class="block mb-2 text-sm font-medium text-white">Loại mẫu</label>
                    <input type="text" id="loaimau" name="loaimau" value="{{ $simple->loaimau }}"
                        class="border text-sm rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500"
                        required />
                </div>
                <div class="mb-1">
                    <label for="color" class="block mb-2 text-sm font-medium text-white">Màu</label>
                    <input type="text" name="color" value="{{ $simple->color }}"
                        class="border text-sm rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500"
                        required />
                </div>
                <div class="mb-1">
                    <label for="size" class="block mb-2 text-sm font-medium text-white">Size</label>
                    <input type="text" name="size" value="{{ $simple->size }}"
                        class="border text-sm rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500"
                        required />
                </div>
                <div class="mb-1">
                    <label for="soluong" class="block mb-2 text-sm font-medium text-white">Số lượng</label>
                    <input type="number" min="0" name="soluong" value="{{ $simple->soluong }}"
                        class="border text-sm rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500"
                        required />
                </div>

                <div class="mb-1">
                    <label for="npl" class="block mb-2 text-sm font-medium text-white">Ngày nhận NPL</label>
                    <input type="date" name="npl" value="{{ $simple->npl }}"
                        class="border text-sm rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500"
                        required />
                </div>
                <div class="mb-1">
                    <label for="rap" class="block mb-2 text-sm font-medium text-white">Ngày nhận rập</label>
                    <input type="date" name="rap" value="{{ $simple->rap }}"
                        class="border text-sm rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500"
                        required />
                </div>
                <div class="mb-1">
                    <label for="tailieu" class="block mb-2 text-sm font-medium text-white">Ngày nhận tài liệu</label>
                    <input type="date" name="tailieu" value="{{ $simple->tailieu }}"
                        class="border text-sm rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500"
                        required />
                </div>
                <div class="mb-1">
                    <label for="maugoc" class="block mb-2 text-sm font-medium text-white">Ngày nhận mẫu gốc</label>
                    <input type="date" name="maugoc" value="{{ $simple->maugoc }}"
                        class="border text-sm rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500" />
                </div>
                <div class="mb-1">
                    <label for="ktmay" class="block mb-2 text-sm font-medium text-white">Kỹ thuật may</label>
                    <input type="text" name="ktmay" value="{{ $simple->ktmay }}"
                        class="border text-sm rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500"
                        required />
                </div>
                <div class="mb-1">
                    <label for="kcs" class="block mb-2 text-sm font-medium text-white">KC kiểm</label>
                    <input type="text" name="kcs" value="{{ $simple->kcs }}"
                        class="border text-sm rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500" />
                </div>
                <div class="mb-1">
                    <label for="ngaymay" class="block mb-2 text-sm font-medium text-white">Ngày may</label>
                    <input type="date" name="ngaymay" value="{{ $simple->ngaymay }}"
                        class="border text-sm rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500" />
                </div>
                <div class="mb-1">
                    <label for="ngayhen" class="block mb-2 text-sm font-medium text-white">Ngày hẹn</label>
                    <input type="date" name="ngayhen" value="{{ $simple->ngayhen }}"
                        class="border text-sm rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500" />
                </div>
                <div class="mb-1">
                    <label for="ngaygui" class="block mb-2 text-sm font-medium text-white">Ngày gửi mẫu</label>
                    <input type="date" name="ngaygui" value="{{ $simple->ngaygui }}"
                        class="border text-sm rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500" />
                </div>


                <div class="mb-1">
                    <label for="tinhtrang" class="block mb-2 text-sm font-medium text-white">Tình trạng mẫu</label>
                    <select name="tinhtrang"
                        class="border text-sm rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="">--Tình trạng--</option>
                        <option value="dangmay" {{ $simple->tinhtrang === 'dangmay' ? 'selected' : null }}>Đang may
                        </option>
                        <option value="dagui" {{ $simple->tinhtrang === 'dagui' ? 'selected' : null }}>Đã gửi</option>
                    </select>

                </div>
                <div class="mb-1">
                    <label for="ketqua" class="block mb-2 text-sm font-medium text-white">Kết quả</label>
                    <select name="ketqua"
                        class="border text-sm rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="">--Kết quả--</option>
                        <option value="failed" {{ $simple->ketqua === 'failed' ? 'selected' : null }}>Failed</option>
                        <option value="passed" {{ $simple->ketqua === 'passed' ? 'selected' : null }}>Passed</option>
                    </select>

                </div>
                <div class="mb-1">
                    <label for="tuan" class="block mb-2 text-sm font-medium text-white">Tuần</label>
                    <?php
                    $tuan = $simple->tuan;
                    $parts = explode('-', $tuan);
                    if (isset($parts[0]) && isset($parts[1])) {
                        $res = $parts[0] . '-' . $parts[1];
                    }
                    ?>
                    <input type="text" name="tuan" value="{{ $simple->tuan }}" minlength="7" maxlength="8"
                        placeholder="vd: T1-8-24, T2-12-24,..."
                        class="border text-sm rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500" />
                </div>
                <div class="mb-1">
                    <label for="ghichu" class="block mb-2 text-sm font-medium text-white">Ghi chú</label>
                    <input type="text" name="ghichu" value="{{ $simple->ghichu }}"
                        class="border text-sm rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500" />
                </div>
                <div class="mb-1">
                    <label for="bienban" class="block mb-2 text-sm font-medium text-white">Biên bản</label>
                    <select name="bienban"
                        class="border text-sm rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="">--Kết quả--</option>
                        <option value="0" {{ $simple->bienban == 0 ? 'selected' : null }}>Chưa có</option>
                        <option value="1" {{ $simple->bienban == 1 ? 'selected' : null }}>Đã có</option>
                    </select>
                </div>

                <div class="flex justify-start items-end mb-1 col-span-2 gap-1">
                    <a href="{{ route('simple.dashboard') }}"
                        class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Hủy</a>
                    <button type="submit" value="simple-new" name="action"
                        class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">
                        Thêm mới
                    </button>
                    <button type="submit" value="simple-edit" name="action"
                        class="text-white
                        bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium
                        rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">
                        Cập nhật
                    </button>

                </div>

        </div>
    </div>
@endsection
@push('scripts')
    <script>
        // const editBtn = document.getElementById("simple-edit");
        // const newBtn = document.getElementById("simple-new");
        // const form = document.getElementById("form-edit-new");
        // editBtn.addEventListener("click", function(e) {
        //     e.preventDefault();
        //     editBtn.name = "simple-edit";
        //     form.submit();
        // })
        // newBtn.addEventListener("click", function(e) {
        //     e.preventDefault();
        //     editBtn.name = "simple-new";
        //     form.submit();
        // })
    </script>
@endpush
