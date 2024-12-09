@extends('layouts.finished')

@section('content')
    <div class="absolute right-2 top-2 flex items-center gap-4">
        <button id="btn-finished-add" onclick="document.querySelector('#finished-add').classList.toggle('hidden')">
            <img class="w-8" src="{{ asset('images/plus.png') }}" alt="">
        </button>
    </div>

    <div class="main">


        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            VỊ TRÍ
                        </th>
                        <th scope="col" class="px-6 py-3">
                            KHÁCH HÀNG
                        </th>
                        <th scope="col" class="px-6 py-3">
                            MÃ HÀNG
                        </th>
                        <th scope="col" class="px-6 py-3">
                            PO
                        </th>
                        <th scope="col" class="px-6 py-3">
                            SIZE
                        </th>
                        <th scope="col" class="px-6 py-3">
                            MÀU
                        </th>
                        <th scope="col" class="px-6 py-3">
                            KẾ HOẠCH
                        </th>
                        <th scope="col" class="px-6 py-3">
                            ĐÃ NHẬP
                        </th>
                        <th scope="col" class="px-6 py-3">
                            ĐÃ ĐÓNG
                        </th>
                        <th scope="col" class="px-6 py-3">
                            PRE-FINAL
                        </th>
                        <th scope="col" class="px-6 py-3">
                            FINAL
                        </th>
                        <th scope="col" class="px-6 py-3">
                            NGÀY XUẤT
                        </th>
                        <th scope="col" class="px-6 py-3">
                            SỐ THÙNG
                        </th>


                    </tr>
                </thead>
                <tbody>
                    @foreach ($finishes as $finish)
                        <tr class="bg-white border-b hover:bg-gray-50">
                            <th scope="row" class="p-2">
                                {{ $finish->vitri }}
                            </th>
                            <th scope="row" class="p-2">
                                {{ $finish->khachhang }}
                            </th>
                            <td class="p-2">
                                {{ $finish->mahang }}
                            </td>
                            <td class="p-2">
                                {{ $finish->po }}
                            </td>
                            <td class="p-2">
                                {{ $finish->size }}
                            </td>
                            <td class="p-2">
                                {{ $finish->mau }}
                            </td>
                            <td class="p-2">
                                {{ $finish->slkh }}
                            </td>
                            <td class="p-2">
                                {{ $finish->danhap }}
                            </td>
                            <td class="p-2">
                                {{ $finish->dadong }}
                            </td>
                            <td class="p-2">
                                {{ $finish->final }}
                            </td>
                            <td class="p-2">
                                {{ $finish->ngay_final }}
                            </td>
                            <td class="p-2">
                                {{ $finish->ngay_xuat }}
                            </td>
                            <td class="p-2">
                                {{ $finish->sothung }}
                            </td>
                            <td class="p-2">

                                <a title="Chỉnh sửa"
                                    class="no-underline flex justify-center text-green-600 transition hover:scale-125"
                                    href="{{ route('finished.edit', $finish) }}">
                                    <svg fill="none" height="16" stroke="currentColor" stroke-linecap="round"
                                        stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" width="16">
                                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7">
                                        </path>
                                        <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z">
                                        </path>
                                    </svg>
                                </a>
                            </td>

                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>

    </div>

    {{-- Modal --}}
    <div id="finished-add" tabindex="-1" aria-hidden="true"
        class="hidden bg-black overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-4xl max-h-full mx-auto flex h-screen justify-center items-center">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow w-full">
                <!-- Modal header -->
                <form method="POST" action="{{ route('finished.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                        <h3 class="text-xl font-semibold text-gray-900 uppercase">
                            Thêm mới
                        </h3>
                        <button type="button" onclick="document.querySelector('#finished-add').classList.toggle('hidden')"
                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                            data-modal-hide="default-modal">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="p-4 md:p-5 bg-white uppercase grid grid-cols-2 md:grid-cols-3 gap-2">
                        <div class="mb-1">
                            <label for="khachhang" class="block mb-2 text-sm font-medium">Khách hàng</label>
                            <input type="text" id="khachhang" name="khachhang" required
                                class="border text-sm rounded-lg block w-full p-2.5 bg-white" />
                        </div>
                        <div class="mb-1">
                            <label for="mahang" class="block mb-2 text-sm font-medium">Mã hàng</label>
                            <input type="text" id="mahang" name="mahang" required
                                class="border text-sm rounded-lg block w-full p-2.5 bg-white" />
                        </div>
                        <div class="mb-1">
                            <label for="mau" class="block mb-2 text-sm font-medium">Màu</label>
                            <input type="text" id="mau" name="mau"
                                class="border text-sm rounded-lg block w-full p-2.5 bg-white" />
                        </div>
                        <div class="mb-1">
                            <label for="size" class="block mb-2 text-sm font-medium">Size</label>
                            <input type="text" id="size" name="size"
                                class="border text-sm rounded-lg block w-full p-2.5 bg-white" />
                        </div>
                        <div class="mb-1">
                            <label for="po" class="block mb-2 text-sm font-medium">PO</label>
                            <input type="text" id="po" name="po"
                                class="border text-sm rounded-lg block w-full p-2.5 bg-white" />
                        </div>
                        <div class="mb-1">
                            <label for="slkh" class="block mb-2 text-sm font-medium">Kế hoạch</label>
                            <input type="number" id="slkh" name="slkh"
                                class="border text-sm rounded-lg block w-full p-2.5 bg-white" />
                        </div>
                        <div class="mb-1">
                            <label for="vitri" class="block mb-2 text-sm font-medium">Vị trí</label>
                            <select id="vitri" name="vitri"
                                class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                <option value="">Chọn vị trí</option>
                                <option value="A01">A01</option>
                                <option value="A02">A02</option>
                                <option value="A03">A03</option>
                                <option value="A04">A04</option>
                                <option value="A05">A05</option>
                                <option value="A06">A06</option>
                                <option value="B01">B01</option>
                                <option value="B02">B02</option>
                                <option value="B03">B03</option>
                                <option value="B04">B04</option>
                                <option value="B05">B05</option>
                                <option value="B06">B06</option>
                            </select>
                        </div>
                    </div>
                    <!-- Modal footer -->
                    <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b">
                        <button data-modal-hide="default-modal" type="submit"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Thêm
                            mới</button>
                        <button data-modal-hide="default-modal" type="button"
                            onclick="document.querySelector('#finished-add').classList.toggle('hidden')"
                            class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100">Hủy</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection
