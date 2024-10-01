@extends('layouts.app')
@section('title', 'QUẢN LÝ XUẤT NHẬP TỒN PHỤ LIỆU')
@push('styles')
    <style>
        table th {
            min-width: 50px;
        }
    </style>
@endpush
@section('content')
    <div class="min-h-screen flex flex-col bg-white">
        <div id="header" class="flex items-center px-2 py-1 bg-blue-500 text-white">
            <a href="{{ route('accessory.dashboard') }}">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-10">
            </a>
            <h1 class="text-center text-2xl uppercase font-bold w-full">QUẢN LÝ XUẤT NHẬP PHỤ LIỆU</h1>
            <a href="{{ route('accessory.add') }}" title="Nhập kho" class="w-8">
                <img src="{{ asset('images/plus.png') }}" alt="Nhập kho">
            </a>
        </div>


        @if (count($accessories))
            <div class="relative overflow-x-auto">
                <div class="relative overflow-x-auto shadow-md">
                    <table class="uppercase w-full text-base text-center">
                        <thead class="text-white uppercase bg-blue-500">
                            <tr>
                                <th class="border min-w-24">
                                    NGÀY
                                </th>
                                <th class="border">
                                    DÃY
                                </th>
                                <th class="border">
                                    KHÁCH HÀNG
                                </th>
                                <th class="border">
                                    MÃ HÀNG
                                </th>
                                <th class="border">
                                    LOẠI PL
                                </th>
                                <th class="border">
                                    MÀU
                                </th>
                                <th class="border">
                                    SIZE
                                </th>
                                <th class="border">
                                    ĐƠN VỊ
                                </th>
                                <th class="border">
                                    PO
                                </th>

                                <th class="border">
                                    NHẬP
                                </th>
                                <th class="border">
                                    XUẤT
                                </th>
                                <th class="border">
                                    NGƯỜI NHẬN
                                </th>
                                <th class="border">
                                    GHI CHÚ
                                </th>
                                {{-- <th class="border">
                                </th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($accessories as $accessory)
                                <tr class="test-sm bg-gray-50 hover:bg-gray-200 border-b">
                                    <td title="id-{{ $accessory->id }}" class="border text-left py-2 px-1 border-black">
                                        <div class="w-6 inline-block">
                                            @if (!count($accessory->orders))
                                                <form id="form-delete" method="POST"
                                                    action="{{ route('accessory.delete', $accessory) }}" method="post"
                                                    class="inline-block">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        onclick="return confirm('Xác nhận xóa phụ liệu này?')"
                                                        title="Xóa phụ liệu"
                                                        class="btn-show-modal w-5 transform hover:text-red-500 transition hover:scale-110">
                                                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                            </path>
                                                        </svg>
                                                    </button>
                                                </form>
                                            @endif
                                        </div>

                                        <span>{{ formatDate($accessory->ngay, 'd-m-Y') }}</span>
                                    </td>
                                    <td class="border py-2 px-1 border-black">
                                        <a class="underline"
                                            href="{{ route('accessory.row', $accessory->day) }}">{{ $accessory->day }}</a>
                                    </td>
                                    <td class="border py-2 px-1 border-black">
                                        {{ $accessory->khachhang }}
                                    </td>
                                    <td class="border py-2 px-1 border-black">
                                        <a class="underline" href="{{ route('accessory.style', $accessory) }}">
                                            {{ $accessory->mahang }}
                                        </a>
                                    </td>
                                    <td class="border py-2 px-1 border-black">
                                        <a class="underline" href="{{ route('accessory.type', $accessory) }}">
                                            {{ $accessory->loai }}
                                        </a>
                                    </td>
                                    <td class="border py-2 px-1 border-black">
                                        {{ $accessory->mau }}
                                    </td>
                                    <td class="border py-2 px-1 border-black">
                                        {{ $accessory->size }}
                                    </td>
                                    <td class="border py-2 px-1 border-black">
                                        {{ $accessory->donvi }}
                                    </td>
                                    <td class="border py-2 px-1 border-black">
                                        {{ $accessory->po }}
                                    </td>
                                    {{-- Nhập kho --}}
                                    @if (!$accessory->order_id)
                                        <td
                                            class="underline text-sm bg-green-700 text-green-200 whitespace-nowrap border border-black">
                                            <a
                                                href="{{ route('accessory.add', $accessory) }}">{{ formatNumber($accessory->soluong, 2) }}</a>
                                        </td>
                                    @else
                                        <td class="text-sm border border-black whitespace-nowrap">
                                            <a class="no-underline flex justify-center text-green-600 transition hover:scale-125"
                                                href="{{ route('accessory.add', $accessory->order_id) }}">
                                                <svg fill="none" height="16" stroke="currentColor"
                                                    stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    viewBox="0 0 24 24" width="16">
                                                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7">
                                                    </path>
                                                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z">
                                                    </path>
                                                </svg>
                                            </a>
                                        </td>
                                    @endif


                                    @if ($accessory->order_id)
                                        <td class="text-sm border border-black  bg-red-700 text-red-200 whitespace-nowrap">
                                            <a class="underline"
                                                href="{{ route('accessory.order', $accessory->order_id) }}">{{ $accessory->soluong }}</a>
                                        </td>
                                    @else
                                        <td class="text-sm border border-black">
                                            <a class="no-underline flex justify-center text-red-600 dark:text-red-300 transition hover:scale-125"
                                                href="{{ route('accessory.order', $accessory) }}">
                                                <svg fill="none" height="16" stroke="currentColor"
                                                    stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    viewBox="0 0 24 24" width="16">
                                                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7">
                                                    </path>
                                                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z">
                                                    </path>
                                                </svg>
                                            </a>
                                        </td>
                                    @endif

                                    <td class="border py-2 px-1 border-black">
                                        {{ $accessory->nguoinhan }}
                                    </td>
                                    <td class="border py-2 px-1 border-black">
                                        {{ $accessory->ghichu }}
                                    </td>
                                    {{-- @if ($accessory->order_id)
                                        <td class="border py-2 px-1 border-black">
                                            <div class="flex gap-1 justify-center items-center px-2">
                                                <form method="POST" id="form-delete"
                                                    action="{{ route('accessory.delete', $accessory->id) }}"
                                                    class="inline-block">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" onclick="return confirm('Xác nhận xóa?')"
                                                        title="Xóa phụ liệu"
                                                        class="btn-show-modal w-5 transform hover:text-red-500 transition hover:scale-110">
                                                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                            </path>
                                                        </svg>
                                                    </button>
                                                </form>
                                            </div>

                                        </td>
                                    @else
                                        <td class="border py-2 px-1 border-black"></td>
                                    @endif --}}


                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>


            </div>
        @endif


    </div>
@endsection
