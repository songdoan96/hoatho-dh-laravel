@extends('layouts.app')
@section('content')
    <div class="min-h-screen flex flex-col">
        <div id="header" class="flex items-center px-2 py-1 bg-blue-500 text-white">
            <a href="{{ route('cutting.dashboard') }}" class="w-10">
                <img src="{{ asset('images/logo.png') }}" alt="Logo">
            </a>
            <div class="flex items-center gap-4 flex-1 justify-center">
                <h1 class="text-center text-2xl uppercase font-bold">CẬP NHẬT THÔNG TIN BÁN THÀNH PHẨM</h1>

            </div>
        </div>
        <div class="mx-auto w-full">
            <div class="md:w-5/12 mx-auto text-xl text-black bg-gray-300 py-2 px-6 uppercase">
                <div class="flex"><span class="w-2/5 font-semibold">Ngày: </span><span>{{ date('d-m-Y') }}</span>
                </div>
                <div class="flex"><span class="w-2/5 font-semibold">Chuyền: </span><span>{{ $plan->chuyen }}</span>
                </div>
                <div class="flex"><span class="w-2/5 font-semibold">Khách hàng: </span><span>{{ $plan->khachhang }}</span>
                </div>
                <div class="flex"><span class="w-2/5 font-semibold">Mã hàng: </span><span>{{ $plan->mahang }}</span></div>
                <div class="flex"><span class="w-2/5 font-semibold">LK tác nghiệp:
                    </span><span>{{ $plan->sltacnghiep }}</span></div>
                <div class="flex"><span class="w-2/5 font-semibold">BTP:
                    </span><span>{{ $plan->btpcap }}</span></div>
                <div class="flex"><span class="w-2/5 font-semibold">BTP cắt:
                    </span><span>{{ $plan->btp_day->sum('slcat') }}</span></div>
                <div class="flex"><span class="w-2/5 font-semibold">BTP cấp:
                    </span><span>{{ $plan->btp_day->sum('slcap') }}</span></div>
            </div>

            <form method="POST" action="{{ route('produce.editBtpUpdate', $plan) }}"
                class="p-4 border w-5/12 mx-auto mb-2">
                @csrf
                <div class="my-2 flex items-center gap-2">
                    <label for="btp" class="font-medium w-1/2">BTP đã cấp</label>
                    <input type="number" id="btp" name="btp" readonly value="{{ $plan->btpcap }}"
                        class="flex-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5" />
                </div>
                <div class="my-2 flex items-center gap-2">
                    <label for="btpNew" class="font-medium w-1/2">BTP cấp thêm</label>
                    <input type="number" id="btpNew" name="btpNew" max="{{ $plan->sltacnghiep - $plan->btpcap }}"
                        class="flex-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5" />
                </div>
                <div class="flex justify-center gap-2">
                    <a href="{{ route('produce.dashboard') }}"
                        class="text-white bg-red-700 hover:bg-red-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center ">Hủy</a>
                    <button type="submit"
                        class="text-white bg-blue-700 hover:bg-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center ">
                        Cập nhật
                    </button>
                </div>
            </form>

            @if (count($btp))
                <div class="flex justify-center items-center w-full py-2">
                    <form class="w-2/3 mx-auto flex justify-center" action="{{ route('cutting.btpUploadLine') }}"
                        method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="file" name="file" id="file" required=""
                            class="text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                        <button type="submit" id="accessory-upload-btn"
                            class="text-white bg-white-700 bg-blue-500 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                            Tải lên
                        </button>
                    </form>
                </div>
            @endif

            <div class="flex justify-center mt-2">
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="w-full text-left font-bold text-gray-500 ">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-200">
                            <tr>
                                <th scope="col" class="px-6 py-2">
                                    Size
                                </th>
                                <th scope="col" class="px-6 py-2">
                                    Màu
                                </th>
                                <th scope="col" class="px-6 py-2">
                                    SLKH
                                </th>
                                <th scope="col" class="px-6 py-2">
                                    SL cắt
                                </th>
                                <th scope="col" class="px-6 py-2">
                                    LK cắt
                                </th>
                                <th scope="col" class="px-6 py-2">
                                    SL chưa cắt
                                </th>
                                <th scope="col" class="px-6 py-2">
                                    SL cấp
                                </th>
                                <th scope="col" class="px-6 py-2">
                                    LK cấp
                                </th>
                                <th scope="col" class="px-6 py-2">
                                    SL chưa cấp
                                </th>
                                <th scope="col" class="px-6 py-2 flex gap-4">
                                    <button id="btn-btp-add" class="w-6">
                                        <img src="{{ asset('images/plus.png') }}" alt="">
                                    </button>
                                    @if (count($btp))
                                        <a href="{{ route('cutting.exportFileBtp', $plan) }}">
                                            <img src="{{ asset('images/download.png') }}" alt="" class="w-6">
                                        </a>
                                    @endif
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($btp as $bt)
                                <tr
                                    class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                                    <th scope="row"
                                        class="px-6 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $bt->size }}
                                    </th>
                                    <td class="px-6 py-2">
                                        {{ $bt->color }}
                                    </td>
                                    <td class="px-6 py-2 font-bold text-blue-600">
                                        <a href="{{ route('cutting.btpEditPlan', $bt) }}" class="underline">
                                            {{ $bt->slkh }}
                                        </a>
                                    </td>
                                    @php
                                        $btDay = $bt->btpDay->where('ngay', date('Y-m-d'))->first();
                                        $lkcat = $bt->btpDay->where('btp_id', $bt->id)->sum('slcat');
                                        $lkcap = $bt->btpDay->where('btp_id', $bt->id)->sum('slcap');
                                    @endphp
                                    <td class="px-6 py-2">
                                        <a class="underline text-green-700"
                                            href="{{ route('cutting.editBtpWithDay', $bt) }}">
                                            {{ $btDay->slcat ?? 0 }}
                                        </a>
                                    </td>
                                    <td class="px-6 py-2 text-green-700">
                                        {{ $lkcat ?? 0 }}
                                    </td>
                                    <td class="px-6 py-2 text-green-700">
                                        {{ $bt->slkh - $lkcat ?? 0 }}
                                    </td>
                                    <td class="px-6 py-2 text-red-700">
                                        <a class="underline" href="{{ route('cutting.editBtpWithDay', $bt) }}">
                                            {{ $btDay->slcap ?? 0 }}
                                        </a>
                                    </td>
                                    <td class="px-6 py-2 text-red-700">

                                        {{ $lkcap ?? 0 }}
                                    </td>
                                    <td class="px-6 py-2 text-red-700">
                                        {{ $lkcat - $lkcap ?? 0 }}
                                    </td>
                                    <td class="px-6 py-2">
                                        <div class="flex items-center gap-2">
                                            @if ($lkcat == 0 && $lkcap == 0)
                                                <form action="{{ route('cutting.btpDelete', $bt) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button title="Xóa" onclick="return confirm('Xác nhận xóa?')">
                                                        <img class="w-4 transition hover:scale-125"
                                                            src="{{ asset('images/trash.png') }}" alt="">
                                                    </button>
                                                </form>
                                            @else
                                                <a title="Chi tiết" href="{{ route('cutting.detailBtp', $bt) }}"
                                                    class="transition hover:scale-125">
                                                    <img src="{{ asset('images/info.png') }}" class="w-4"
                                                        alt="">
                                                </a>
                                            @endif
                                            <a title="Cập nhật"
                                                class="no-underline flex justify-center text-green-600 transition hover:scale-125"
                                                href="{{ route('cutting.editBtpWithDay', $bt) }}">
                                                <svg fill="none" height="16" stroke="currentColor"
                                                    stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    viewBox="0 0 24 24" width="16">
                                                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7">
                                                    </path>
                                                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z">
                                                    </path>
                                                </svg>
                                            </a>
                                        </div>

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>




    <!-- Main modal -->
    <div id="modal-btp-add"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-2xl max-h-full mx-auto">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">

                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        Thêm thông tin mã hàng
                    </h3>
                    <button type="button" onclick="document.getElementById('modal-btp-add').classList.add('hidden')"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="bg-white flex justify-between mb-2 px-4 py-2">
                    <div class="flex gap-2 items-end mb-2">
                        <img src="{{ asset('images/download.png') }}" alt="Download" width="40">
                        <a class="underline" href="{{ route('downloadFile', 'btp') }}">
                            Tải file mẫu
                        </a>
                    </div>
                    <form action="{{ route('cutting.btpUpload') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="plan_id" value="{{ $plan->id }}">
                        <input type="file" name="file" id="file" required
                            class="text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                        <button type="submit" id="accessory-upload-btn"
                            class="text-white bg-white-700 bg-blue-500 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                            Tải lên
                        </button>
                    </form>
                </div>
                <form action="{{ route('cutting.addBtpWithPlan') }}" method="post">
                    @csrf
                    <input type="hidden" name="plan_id" value="{{ $plan->id }}">
                    <div class="p-4 md:p-5 space-y-4">
                        <div class="grid gap-6 mb-6 md:grid-cols-1">
                            <div>
                                <label for="size"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Size</label>
                                <input type="text" id="size" name="size"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                            </div>
                            <div>
                                <label for="color"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Màu</label>
                                <input type="text" id="color" name="color"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                            </div>
                            <div>
                                <label for="slkh"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">SLKH</label>
                                <input type="number" id="slkh" name="slkh" required
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                            </div>
                        </div>
                    </div>
                    <!-- Modal footer -->
                    <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                        <button type="submit"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Thêm</button>
                        <button type="button" onclick="document.getElementById('modal-btp-add').classList.add('hidden')"
                            class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Hủy</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const btnBtpAdd = document.querySelector("#btn-btp-add")
            btnBtpAdd.addEventListener("click", function() {
                document.querySelector("#modal-btp-add").classList.remove("hidden")
            })
        })
    </script>
@endpush
