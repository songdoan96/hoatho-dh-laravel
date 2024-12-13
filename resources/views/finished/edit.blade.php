@extends('layouts.finished')
@section('header-title', 'Chỉnh sửa')

@section('content')
    <div class="main p-4 bg-white">
        <form class="shadow-lg border rounded" id="form-edit-finished" method="POST"
            action="{{ route('finished.update', $finished) }}" enctype="multipart/form-data">
            @csrf
            <div class="p-4 md:p-5 bg-gray-100 uppercase grid grid-cols-2 md:grid-cols-4 gap-2">
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
                    <label for="danhap" class="block mb-2 text-sm font-medium">Đã nhập</label>
                    <input type="number" id="danhap" name="danhap" value="{{ $finished->danhap }}"
                        class="border text-sm rounded-lg block w-full p-2.5 bg-white" />
                </div>
                <div class="mb-1">
                    <label for="dadong" class="block mb-2 text-sm font-medium">Đã đóng</label>
                    <input type="number" id="dadong" name="dadong" value="{{ $finished->dadong }}"
                        class="border text-sm rounded-lg block w-full p-2.5 bg-white" />
                </div>
                <div class="mb-1">
                    <label for="sothung" class="block mb-2 text-sm font-medium">Số thùng</label>
                    <input type="text" id="sothung" name="sothung" value="{{ $finished->sothung }}"
                        class="border text-sm rounded-lg block w-full p-2.5 bg-white" />
                </div>
                <div class="mb-1">
                    <label for="vitri" class="block mb-2 text-sm font-medium">Vị trí</label>
                    <input type="text" id="vitri" name="vitri" value="{{ $finished->vitri }}"
                        class="border text-sm rounded-lg block w-full p-2.5 bg-white" />
                </div>
                <div class="mb-1">
                    <label for="kichthung" class="block mb-2 text-sm font-medium">Kích thùng</label>
                    <input type="text" id="kichthung" name="kichthung" value="{{ $finished->kichthung }}"
                        class="border text-sm rounded-lg block w-full p-2.5 bg-white" />
                </div>
                <div class="mb-1">
                    <label for="ngay_prefinal" class="block mb-2 text-sm font-medium">Ngày Pre-Final</label>
                    <input type="date" id="ngay_prefinal" name="ngay_prefinal" value="{{ $finished->ngay_prefinal }}"
                        class="border text-sm rounded-lg block w-full p-2.5 bg-white" />
                </div>
                <div class="mb-1">
                    <label for="prefinal" class="block mb-2 text-sm font-medium text-gray-900">Pre-Final</label>
                    <select id="prefinal" name="prefinal"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        <option value="0" {{ $finished->prefinal == 0 ? 'selected' : null }}>== Chưa có thông tin
                            ==
                        </option>
                        <option value="1" {{ $finished->prefinal == 1 ? 'selected' : null }}>PASSED</option>
                        <option value="2" {{ $finished->prefinal == 2 ? 'selected' : null }}>FAILED</option>
                    </select>
                </div>
                <div class="mb-1">
                    <label for="ngay_final" class="block mb-2 text-sm font-medium">Ngày Final</label>
                    <input type="date" id="ngay_final" name="ngay_final" value="{{ $finished->ngay_final }}"
                        class="border text-sm rounded-lg block w-full p-2.5 bg-white" />
                </div>
                <div class="mb-1">
                    <label for="final" class="block mb-2 text-sm font-medium text-gray-900">Final</label>
                    <select id="final" name="final"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        <option value="0" {{ $finished->final == 0 ? 'selected' : null }}>== Chưa có thông tin
                            ==
                        </option>
                        <option value="1" {{ $finished->final == 1 ? 'selected' : null }}>PASSED</option>
                        <option value="2" {{ $finished->final == 2 ? 'selected' : null }}>FAILED</option>
                    </select>
                </div>
                <div class="mb-1">
                    <label for="ngay_xuat" class="block mb-2 text-sm font-medium">Ngày xuất</label>
                    <input type="date" id="ngay_xuat" name="ngay_xuat" value="{{ $finished->ngay_xuat }}"
                        class="border text-sm rounded-lg block w-full p-2.5 bg-white" />
                </div>
            </div>
            <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b bg-gray-200 justify-end gap-4">
                <a href="{{ route('finished.dashboard') }}"
                    class="py-2.5 px-5 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100">Hủy</a>

                <button type="submit"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Cập
                    nhật</button>
            </div>
        </form>


    </div>
@endsection
@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const formAddFinished = document.getElementById("form-edit-finished");
            const inputs = formAddFinished.querySelectorAll("input");
            inputs.forEach(input => {
                input.addEventListener("change", function(e) {

                    input.value = e.target.value.toUpperCase();
                })
            });
        })
    </script>
@endpush
