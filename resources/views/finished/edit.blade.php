@extends('layouts.finished')

@section('content')
    <div class="absolute right-2 top-2 flex items-center gap-4">
        <button id="btn-finished-add" onclick="document.querySelector('#finished-add').classList.toggle('hidden')">
            <img class="w-8" src="{{ asset('images/plus.png') }}" alt="">
        </button>
    </div>

    <div class="main">
        <form method="POST" action="{{ route('finished.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="p-4 md:p-5 bg-white uppercase grid grid-cols-2 md:grid-cols-4 gap-2">
                <div class="mb-1">
                    <label for="khachhang" class="block mb-2 text-sm font-medium">Khách hàng</label>
                    <input type="text" id="khachhang" name="khachhang" required value="{{ $finished->khachhang }}"
                        class="border text-sm rounded-lg block w-full p-2.5 bg-white" />
                </div>
                <div class="mb-1">
                    <label for="mahang" class="block mb-2 text-sm font-medium">Mã hàng</label>
                    <input type="text" id="mahang" name="mahang" required value="{{ $finished->mahang }}"
                        class="border text-sm rounded-lg block w-full p-2.5 bg-white" />
                </div>
                <div class="mb-1">
                    <label for="mau" class="block mb-2 text-sm font-medium">Màu</label>
                    <input type="text" id="mau" name="mau" value="{{ $finished->mau }}"
                        class="border text-sm rounded-lg block w-full p-2.5 bg-white" />
                </div>
                <div class="mb-1">
                    <label for="size" class="block mb-2 text-sm font-medium">Size</label>
                    <input type="text" id="size" name="size" value="{{ $finished->size }}"
                        class="border text-sm rounded-lg block w-full p-2.5 bg-white" />
                </div>
                <div class="mb-1">
                    <label for="po" class="block mb-2 text-sm font-medium">PO</label>
                    <input type="text" id="po" name="po" value="{{ $finished->po }}"
                        class="border text-sm rounded-lg block w-full p-2.5 bg-white" />
                </div>
                <div class="mb-1">
                    <label for="slkh" class="block mb-2 text-sm font-medium">Kế hoạch</label>
                    <input type="number" id="slkh" name="slkh" value="{{ $finished->slkh }}"
                        class="border text-sm rounded-lg block w-full p-2.5 bg-white" />
                </div>
                <div class="mb-1">
                    <label for="vitri" class="block mb-2 text-sm font-medium">Vị trí</label>
                    <select id="vitri" name="vitri"
                        class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        <option value="">Chọn vị trí</option>
                        <option value="A01" {{ $finished->vitri == 'A01' ? 'selected' : null }}>A01</option>
                        <option value="A02" {{ $finished->vitri == 'A02' ? 'selected' : null }}>A02</option>
                        <option value="A03" {{ $finished->vitri == 'A03' ? 'selected' : null }}>A03</option>
                        <option value="A04" {{ $finished->vitri == 'A04' ? 'selected' : null }}>A04</option>
                        <option value="A05" {{ $finished->vitri == 'A05' ? 'selected' : null }}>A05</option>
                        <option value="A06" {{ $finished->vitri == 'A06' ? 'selected' : null }}>A06</option>
                        <option value="B01" {{ $finished->vitri == 'B01' ? 'selected' : null }}>B01</option>
                        <option value="B02" {{ $finished->vitri == 'B02' ? 'selected' : null }}>B02</option>
                        <option value="B03" {{ $finished->vitri == 'B03' ? 'selected' : null }}>B03</option>
                        <option value="B04" {{ $finished->vitri == 'B04' ? 'selected' : null }}>B04</option>
                        <option value="B05" {{ $finished->vitri == 'B05' ? 'selected' : null }}>B05</option>
                        <option value="B06" {{ $finished->vitri == 'B06' ? 'selected' : null }}>B06</option>
                    </select>
                </div>
            </div>
            <!-- Modal footer -->
            <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b">
                <button type="submit"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Cập
                    nhật</button>
                <a href="{{ route('finished.dashboard') }}"
                    class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100">Hủy</a>
            </div>
        </form>


    </div>
@endsection
