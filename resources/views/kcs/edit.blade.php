@extends('layouts.app')
@push('meta')
    <meta name="viewport" content="width=device-width, initial-scale=1">
@endpush
@section('content')
    <div class="flex justify-center items-center w-screen min-h-screen bg-black text-white overflow-x-hidden">
        <div class="w-full h-full md:w-1/2 p-4">
            <a href="{{ route('kcs.dashboard') }}" class="flex items-center justify-center">
                <img src="{{ asset('images/logo2.png') }}" alt="Logo" width="300">
            </a>
            <h2 class="bg-blue-500 text-center text-3xl font-bold py-1 my-2">BÁO CÁO KCS {{ $kcs->plans->chuyen }}</h2>
            <h2 class="font-bold text-center text-2xl">{{ formatDate($kcs->ngaytao, 'd/m/Y') }}
                - {{ $kcs->plans->khachhang }}
                - {{ $kcs->plans->mahang }}</h2>
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
            <div class="flex flex-col text-5xl font-bold">
                <div class="flex bg-green-500 p-3 items-center min-h-28">
                    <div class="w-1/3 text-left">ĐẠT</div>
                    <div class="w-2/3 font-bold flex justify-between items-center">
                        <span class="text-7xl font-extrabold">{{ $kcs->sldat }}</span>
                        <form action="{{ route('kcs.passed', $kcs) }}" method="post">
                            @csrf
                            <button type="submit" title="Thêm sp đạt" class="bg-blue-700 text-white p-2 w-20 rounded">
                                +1
                            </button>
                        </form>
                    </div>
                </div>
                <div class="flex bg-red-500 p-3 items-center min-h-28">
                    <div class="w-1/3 text-left">LỖI</div>
                    <div class="w-2/3 flex justify-between items-center">
                        <span class="text-7xl font-extrabold ">{{ $kcs->slloi }}</span>
                        <form action="{{ route('kcs.failed', $kcs) }}" method="post">
                            @csrf
                            <button type="submit" title="Thêm sp lỗi" class="bg-blue-700 text-white p-2 w-20 rounded">
                                +1
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="flex flex-col justify-center items-center my-2">
                <h2 class="uppercase font-bold text-xl py-2">Vướng mắc</h2>
                <form method="post" action="{{ route('kcs.updateErrorInfo', $kcs) }}" class="flex flex-col w-full">
                    @csrf
                    <textarea name="chitietloi" class="w-full border border-black bg-white text-black p-2" rows="3">{{ $kcs->chitietloi }}</textarea>
                    <div class="flex justify-center w-full gap-4 my-2">
                        <a href="{{ route('kcs.dashboard') }}"
                            class="text-white bg-red-500 hover:bg-red-860 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Hủy</a>
                        <button type="submit"
                            class="text-white bg-blue-500 hover:bg-blue-600 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">
                            Cập nhật
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const allBtnSubmit = document.querySelectorAll('button[type="submit"]');
            allBtnSubmit.forEach(btn => {
                btn.addEventListener("click", function(e) {
                    this.setAttribute('disabled', 'disabled');
                    this.form.submit();
                })
            })
        });
    </script>
@endpush
