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
            <h1 class="text-center text-2xl uppercase font-bold w-full">QUẢN LÝ XUẤT NHẬP TỒN PHỤ LIỆU</h1>

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
                                    <td title="id-{{ $accessory->id }}" class="border py-2 px-1 border-black">
                                        {{ formatDate($accessory->ngay, 'd-m-Y') }}
                                    </td>
                                    <td class="border py-2 px-1 border-black">
                                        {{ $accessory->day }}
                                    </td>
                                    <td class="border py-2 px-1 border-black">
                                        {{ $accessory->khachhang }}
                                    </td>
                                    <td class="border py-2 px-1 border-black">
                                        {{ $accessory->mahang }}

                                    </td>
                                    <td class="border py-2 px-1 border-black">
                                        {{ $accessory->loai }}

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
                                            class="text-sm bg-green-700 text-green-200 whitespace-nowrap border border-black">
                                            {{ formatNumber($accessory->soluong, 2) }}
                                        </td>
                                    @else
                                        <td class="text-sm border border-black whitespace-nowrap">

                                        </td>
                                    @endif


                                    @if ($accessory->order_id)
                                        <td class="text-sm border border-black  bg-red-700 text-red-200 whitespace-nowrap">
                                            {{ $accessory->soluong }}
                                        </td>
                                    @else
                                        <td class="text-sm border border-black">

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
