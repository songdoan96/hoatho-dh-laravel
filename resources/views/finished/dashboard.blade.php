@extends('layouts.finished')

@section('content')
    <div class="absolute right-2 top-2 flex items-center gap-4">
        <form method="get" class="hidden md:block relative h-8 md:w-44 rounded text-black ml-2">
            <input type="text" name="po" id="po"
                class="absolute z-10 outline-none w-full h-full px-2 py-1.5 bg-gray-200" placeholder="Tìm kiếm PO...">
            <button type="submit" class="absolute right-0 z-20 py-2 px-3 border-l border-black h-full ">
                <svg class="w-4 h-4" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"></path>
                </svg>
            </button>
        </form>
        <a href="{{ route('finished.tv') }}" title="TV">
            <img src="{{ asset('images/tv.svg') }}" alt="TV" class="w-8">
        </a>
        <button id="btn-finished-add" onclick="document.querySelector('#finished-add').classList.toggle('hidden')">
            <img class="w-8" src="{{ asset('images/plus.png') }}" alt="">
        </button>
    </div>

    <div class="main p-2">
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="p-2 border">
                            VỊ TRÍ
                        </th>
                        <th scope="col" class="p-2 border">
                            KHÁCH HÀNG
                        </th>
                        <th scope="col" class="p-2 border">
                            MÃ HÀNG
                        </th>
                        <th scope="col" class="p-2 border">
                            PO
                        </th>
                        <th scope="col" class="p-2 border">
                            SIZE
                        </th>
                        <th scope="col" class="p-2 border">
                            MÀU
                        </th>
                        <th scope="col" class="p-2 border">
                            KẾ HOẠCH
                        </th>
                        <th scope="col" class="p-2 border">
                            ĐÃ NHẬP
                        </th>
                        <th scope="col" class="p-2 border">
                            ĐÃ ĐÓNG
                        </th>
                        <th scope="col" class="p-2 border">
                            PRE-FINAL
                        </th>
                        <th scope="col" class="p-2 border">
                            FINAL
                        </th>
                        <th scope="col" class="p-2 border">
                            NGÀY XUẤT
                        </th>
                        <th scope="col" class="p-2 border">
                            SỐ THÙNG
                        </th>
                        <th scope="col" class="p-2 border">
                            KÍCH THÙNG
                        </th>
                        <th scope="col" class="p-2 border">
                            SỐ KHỐI(m3)
                        </th>
                        <th scope="col" class="p-2 border">

                        </th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($finishes as $finish)
                        <tr class="bg-white border-b hover:bg-gray-50">
                            <th scope="row" class="p-2 border">
                                @if ($finish->vitri)
                                    <a class="underline" href="{{ route('finished.position', $finish->vitri) }}">
                                        {{ $finish->vitri }}
                                    </a>
                                @endif
                            </th>
                            <td class="p-2 border">
                                {{ $finish->khachhang }}
                            </td>
                            <td class="p-2 border">
                                <a class="underline" href="?mahang={{ $finish->mahang }}">
                                    {{ $finish->mahang }}
                                </a>
                            </td>
                            <td class="p-2 border">
                                {{ $finish->po }}
                            </td>
                            <td class="p-2 border">
                                {{ $finish->size }}
                            </td>
                            <td class="p-2 border">
                                {{ $finish->mau }}
                            </td>
                            <td class="p-2 border">
                                {{ $finish->slkh }}
                            </td>
                            <td class="p-2 border">
                                {{ $finish->danhap }}
                            </td>
                            <td class="p-2 border">
                                {{ $finish->dadong }}
                            </td>
                            <td class="p-2 border">
                                {{ formatDate($finish->ngay_prefinal, 'd/m') }}
                                @if ($finish->prefinal == 0)
                                    --
                                @elseif($finish->prefinal == 1)
                                    <span class="bg-green-300 p-1 rounded font-bold">PASSED</span>
                                @else
                                    <span class="bg-red-300 p-1 rounded font-bold">FAILED</span>
                                @endif
                            </td>
                            <td class="p-2 border">
                                {{ formatDate($finish->ngay_final, 'd/m') }}
                                @if ($finish->final == 0)
                                    --
                                @elseif($finish->final == 1)
                                    <span class="bg-green-300 p-1 rounded font-bold">PASSED</span>
                                @else
                                    <span class="bg-red-300 p-1 rounded font-bold">FAILED</span>
                                @endif
                            </td>
                            <td class="p-2 border">
                                {{ formatDate($finish->ngay_xuat, 'd/m') }}
                            </td>
                            <td class="p-2 border">
                                {{ $finish->sothung }}
                            </td>
                            <td class="p-2 border">
                                {{ $finish->kichthung }}
                            </td>
                            <td class="p-2 border">
                                @php
                                    preg_match_all('/\d+/', $finish->kichthung, $matches);
                                    preg_match_all('/\d+/', $finish->sothung, $tongthung);
                                    $numbers = $matches[0];
                                    $thung = $tongthung[0];
                                    if ($numbers && $thung) {
                                        $num1 = $numbers[0];
                                        $num2 = $numbers[1];
                                        $num3 = $numbers[2];
                                        if (str_contains(strtoupper($finish->kichthung), 'CM')) {
                                            $cm = $num1 * $num2 * $num3 * 0.000001 * $thung[0];
                                            echo formatNumber($cm, 3);
                                        } else {
                                            $in = $num1 * $num2 * $num3 * (0.0254 * 0.0254 * 0.0254) * $thung[0];
                                            echo formatNumber($in, 3);
                                        }
                                    }
                                @endphp
                            </td>
                            <td class="p-2 border flex items-center gap-2">
                                <form id="form-delete" method="POST" action="{{ route('finished.destroy', $finish) }}"
                                    method="post" class="flex">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Xác nhận xóa đơn hàng này?')"
                                        title="Xóa đơn hàng"
                                        class="btn-show-modal w-5 transform hover:text-red-500 transition hover:scale-110">
                                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                            </path>
                                        </svg>
                                    </button>
                                </form>
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
    <div id="finished-add" tabindex="-1"
        class="hidden bg-black overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-4xl max-h-full mx-auto flex h-screen justify-center items-center">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow w-full">
                <!-- Modal header -->
                <form id="form-add-finished" method="POST" action="{{ route('finished.store') }}"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                        <h3 class="text-xl font-semibold text-gray-900 uppercase">
                            Thêm mới
                        </h3>
                        <button type="button"
                            onclick="document.querySelector('#finished-add').classList.toggle('hidden')"
                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                            data-modal-hide="default-modal">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="p-4 md:p-5 bg-white uppercase grid grid-cols-2 md:grid-cols-5 gap-2">
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
                            <label for="danhap" class="block mb-2 text-sm font-medium">Đã nhập</label>
                            <input type="number" id="danhap" name="danhap" value="0"
                                class="border text-sm rounded-lg block w-full p-2.5 bg-white" />
                        </div>
                        <div class="mb-1">
                            <label for="dadong" class="block mb-2 text-sm font-medium">Đã đóng</label>
                            <input type="number" id="dadong" name="dadong" value="0"
                                class="border text-sm rounded-lg block w-full p-2.5 bg-white" />
                        </div>
                        <div class="mb-1">
                            <label for="sothung" class="block mb-2 text-sm font-medium">Số thùng</label>
                            <input type="text" id="sothung" name="sothung"
                                class="border text-sm rounded-lg block w-full p-2.5 bg-white" />
                        </div>
                        <div class="mb-1">
                            <label for="vitri" class="block mb-2 text-sm font-medium">Vị trí</label>
                            <input type="text" id="vitri" name="vitri"
                                class="border text-sm rounded-lg block w-full p-2.5 bg-white" />
                        </div>
                        <div class="mb-1">
                            <label for="kichthung" class="block mb-2 text-sm font-medium">Kích thùng</label>
                            <input type="text" id="kichthung" name="kichthung"
                                class="border text-sm rounded-lg block w-full p-2.5 bg-white" />
                        </div>
                        {{-- <div class="mb-1">
                            <label for="ngay_final" class="block mb-2 text-sm font-medium">Ngày final</label>
                            <input type="date" id="ngay_final" name="ngay_final"
                                class="border text-sm rounded-lg block w-full p-2.5 bg-white" />
                        </div>
                        <div class="mb-1">
                            <label for="ngay_xuat" class="block mb-2 text-sm font-medium">Ngày xuất</label>
                            <input type="date" id="ngay_xuat" name="ngay_xuat"
                                class="border text-sm rounded-lg block w-full p-2.5 bg-white" />
                        </div> --}}

                    </div>
                    <!-- Modal footer -->
                    <div class="flex justify-end items-center p-4 md:p-5 border-t border-gray-200 rounded-b gap-2">
                        <button type="button"
                            onclick="document.querySelector('#finished-add').classList.toggle('hidden')"
                            class="py-2.5 px-5 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100">Hủy</button>

                        <button type="submit"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Thêm
                            mới</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const formAddFinished = document.getElementById("form-add-finished");
            const inputs = formAddFinished.querySelectorAll("input");
            inputs.forEach(input => {
                input.addEventListener("change", function(e) {
                    input.value = e.target.value.toUpperCase();
                })
            });
        })
    </script>
@endpush
