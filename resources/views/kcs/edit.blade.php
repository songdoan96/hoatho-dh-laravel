@extends('layouts.app')
@section('title', 'Báo cáo KCS')
@push('meta')
    <meta name="viewport" content="width=device-width, initial-scale=1">
@endpush
@section('content')
    <div class="flex justify-center items-center w-screen bg-black text-white overflow-x-hidden h-screen overflow-y-scroll">
        <div class="w-full h-full md:w-2/3 p-4">
            <h1 class="flex items-center justify-center hidden">
                <img src="{{ asset('images/logo2.png') }}" alt="Logo" width="300">

            </h1>
            <div id="bell" data-line="{{ $kcs->plans->chuyen }}" class="grid grid-cols-4 gap-2 text-sm text-black mt-1">
                <div class="flex items-center justify-center">
                    <button id="codien" data-help="codien"
                        class="btn-help bg-gray-300 border-2 border-white w-20 h-20 rounded-full uppercase font-semibold">Cơ
                        điện</button>
                </div>
                <div class="flex items-center justify-center"><button id="kythuat" data-help="kythuat"
                        class="btn-help bg-gray-300 border-2 border-white w-20 h-20 rounded-full uppercase font-semibold">Kỹ
                        thuật</button></div>
                <div class="flex items-center justify-center"><button id="phulieu" data-help="phulieu"
                        class="btn-help bg-gray-300 border-2 border-white w-20 h-20 rounded-full uppercase font-semibold">Phụ
                        liệu</button></div>
                <div class="flex items-center justify-center"><button id="tocat" data-help="tocat"
                        class="btn-help bg-gray-300 border-2 border-white w-20 h-20 rounded-full uppercase font-semibold">Tổ
                        cắt</button></div>
            </div>
            <h2 class="bg-blue-500 text-center text-3xl font-bold py-1 my-2 flex gap-4 justify-center items-center">
                <span>BÁO CÁO KCS {{ $kcs->plans->chuyen }}</span>
                <label class="inline-flex items-center cursor-pointer hidden">
                    <input name="isShow" id="isShow" type="checkbox" value="{{ $kcs->plans->chuyen }}"
                        class="sr-only peer">
                    <div
                        class="relative w-12 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-green-300 dark:peer-focus:ring-green-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-green-600">
                    </div>
                    <span class="ms-3 text-sm font-medium text-white uppercase">Hỗ trợ</span>
                </label>

            </h2>
            <h2 class="font-bold text-center text-2xl">{{ formatDate($kcs->ngaytao, 'd/m/Y') }}
                - {{ $kcs->plans->khachhang }}
                - {{ $kcs->plans->mahang }}

            </h2>


            <div class="flex my-4">
                <div class="w-1/3 flex flex-col items-center justify-center">
                    <p>Chỉ tiêu</p>
                    <p class="text-3xl font-bold">{{ $kcs->chitieungay }}</p>
                </div>
                <div class="w-1/3 flex flex-col items-center justify-center">
                    <p>Năng suất</p>
                    <p class="text-3xl font-bold"> {{ round(($kcs->sldat / $kcs->chitieungay) * 100, 2) }}%</p>
                </div>
                <div class="w-1/3 flex flex-col items-center justify-center">
                    <p>Tỷ lệ lỗi</p>
                    <p class="text-3xl font-bold">
                        @if ($kcs->sldat == 0 && $kcs->slloi == 0)
                            0%
                        @else
                            {{ round(($kcs->slloi / ($kcs->sldat + $kcs->slloi)) * 100, 2) }}%
                        @endif
                    </p>
                </div>

            </div>
            <div class="flex flex-col justify-center items-center my-2 border">
                <h2 class="uppercase font-bold text-3xl py-2 text-red-400">Vướng mắc</h2>
                {{-- <h2 class="font-bold py-1 text-red-400 p-2">3 lỗi cao nhất phân cách bằng dấu phẩy</h2> --}}
                <form method="post" action="{{ route('kcs.updateErrorInfo', $kcs) }}" class="flex flex-col w-full">
                    @csrf
                    <textarea name="chitietloi" class="w-full border-blue-500 border p-2 text-xl"
                        style="background-color: #d6e6f6 !important;color: #0c0c0c !important;" rows="3">{{ $kcs->chitietloi }}</textarea>
                    <div class="flex justify-center w-full gap-4 my-2">
                        <a href="{{ route('kcs.dashboard') }}"
                            class="text-white bg-red-500 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-xl w-48 px-5 py-2.5 text-center">Hủy</a>
                        <button type="submit"
                            class="text-white bg-blue-500 hover:bg-blue-600 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-xl w-48 px-5 py-2.5 text-center">
                            Cập nhật
                        </button>
                    </div>
                </form>
            </div>
            <div class="flex flex-col gap-8 text-5xl font-bold">
                <div class="flex w-full bg-green-500 p-3 items-center min-h-28">
                    <div class="w-1/3 text-left">ĐẠT</div>
                    <div class="w-2/3 font-bold flex justify-between items-center">
                        <span class="text-7xl font-extrabold">{{ $kcs->sldat }}</span>
                        <form action="{{ route('kcs.passed', $kcs) }}" method="post">
                            @csrf
                            <button type="submit" title="Thêm sp đạt" class="bg-blue-700 text-white p-2 w-32 h-32 rounded">
                                +1
                            </button>
                        </form>
                    </div>
                </div>
                <div class="flex w-full bg-red-500 p-3 items-center min-h-28">
                    <div class="w-1/3 text-left">LỖI</div>
                    <div class="w-2/3 flex justify-between items-center">
                        <span class="text-7xl font-extrabold ">{{ $kcs->slloi }}</span>
                        <form action="{{ route('kcs.failed', $kcs) }}" method="post">
                            @csrf
                            <button type="submit" title="Thêm sp lỗi" class="bg-blue-700 text-white p-2 w-32 h-32 rounded">
                                +1
                            </button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
@push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", async function() {
            const chuyenElement = document.querySelector("#bell");
            const chuyen = chuyenElement.dataset.line;
            if (chuyen.startsWith("XN")) {
                chuyenElement.classList.add("hidden")
            } else {
                const url =
                    "http://172.17.0.30:8888/bell/help/" + chuyen;
                try {
                    const response = await fetch(url);
                    if (!response.ok) {
                        throw new Error(`Response status: ${response.status}`);
                    }

                    const list = await response.json();
                    list.forEach((l) => {
                        if (document.querySelector(`#${l.help}`)) {
                            document
                                .querySelector(`#${l.help}`)
                                .classList.add("bg-green-500");
                        }
                    });
                    const btnHelp = document.querySelectorAll(".btn-help");
                    btnHelp.forEach((btn) => {
                        btn.addEventListener("click", () => {
                            const help = btn.dataset.help;
                            fetch("http://172.17.0.30:8888/bell/help", {
                                method: "POST",
                                body: JSON.stringify({
                                    line: chuyen,
                                    help,
                                }),
                                headers: {
                                    "Content-type": "application/json; charset=UTF-8",
                                },
                            });
                            location.reload();
                        });
                    });
                } catch (error) {
                    console.error(error.message);
                }
            }
        });
    </script>
@endpush
