@extends('layouts.app')
@section('title', 'NHẬP KHO PHỤ LIỆU')

@section('content')
    <div class="min-h-screen flex flex-col bg-gray-200 text-black">
        <div id="header" class="flex items-center px-2 py-1 bg-blue-500 text-white">
            <a href="{{ route('accessory.dashboard') }}">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-10">
            </a>
            <h1 class="text-center text-2xl uppercase font-bold w-full">QUẢN LÝ XUẤT NHẬP TỒN KỆ {{ $day }}</h1>
        </div>
        <div class="relative overflow-x-auto">
            <div class="relative overflow-x-auto flex">
                <div class="flex flex-col w-1/6 py-4">
                    <div class="flex flex-col lg:flex-row gap-2 px-2">
                        <img src="{{ asset('images/warehouse.svg') }}" class="w-8" alt="">
                        <h3 class="text-center uppercase font-bold text-xl">Danh sách kệ</h3>
                    </div>
                    <div class="grid grid-cols-2">
                        @foreach (array_merge(range('A', 'L'), ['TTH']) as $item)
                            <div class="flex items-center justify-center p-2">
                                <a href="{{ route('accessory.row', $item) }}"
                                    class="{{ $day == $item ? 'bg-blue-600 text-white' : 'bg-white text-black' }} h-10 w-full flex items-center justify-center font-bold hover:shadow-md hover:scale-110 transition-all">
                                    {{ $item }}</a>
                            </div>
                        @endforeach
                        {{-- @for ($i = 1; $i <= 12; $i++)
                            <div class="flex items-center justify-center p-2">
                                <a href="{{ route('accessory.row', $i < 10 ? '0' . $i : $i) }}"
                                    class="{{ $day == $i ? 'bg-blue-600 text-white' : 'bg-white text-black' }} h-10 w-full flex items-center justify-center font-bold hover:shadow-md hover:scale-110 transition-all">
                                    {{ $i < 10 ? '0' . $i : $i }}</a>
                            </div>
                        @endfor --}}
                    </div>
                </div>
                <div class="grid grid-cols-1 gap-4 lg:grid-cols-2 lg:gap-8 flex-1 p-4 h-full">
                    @foreach ($accessories as $accessory)
                        <div class="flex bg-white shadow-lg relative">
                            <div
                                class="point w-10 h-10 flex justify-center items-center rounded-full bg-red-600 absolute -right-3 -top-3">
                                <span class="text-white text-xs font-bold">
                                    {{ formatNumber(($accessory->ordersQty() / $accessory->soluong) * 100, 1) . '%' }}
                                </span>
                            </div>
                            <div class="flex flex-col w-1/6 justify-between border-r-2">
                                <div class="h-1/2 border-b py-1 flex flex-col items-center font-semibold text-sm">
                                    <img src="{{ asset('images/brand.svg') }}" alt="Loại" class="w-8">
                                    <span>{{ $accessory->khachhang }}</span>
                                </div>
                                <div class="h-1/2 border-t py-1 flex flex-col items-center font-semibold text-sm">
                                    <img src="{{ asset('images/shirt.svg') }}" alt="Loại" class="w-8">
                                    <a class="underline line-clamp-1" href="{{ route('accessory.style', $accessory) }}">
                                        #{{ $accessory->mahang }}
                                    </a>
                                </div>
                            </div>
                            <div class="flex flex-col justify-between flex-1">
                                <div class="flex justify-between p-2">
                                    <div class="flex flex-col items-center justify-center w-1/3">
                                        <p class="font-bold uppercase">Nhập</p>
                                        <span
                                            class="min-w-28 text-center whitespace-nowrap bg-emerald-100 text-emerald-700 p-1 px-2 text-base font-bold rounded-full">{{ formatNumber($accessory->totalQtyWithRow(), 2) }}<span
                                                class="text-sm"> {{ $accessory->donvi }}</span></span>
                                    </div>
                                    <div class="flex flex-col items-center justify-center w-1/3">
                                        <p class="font-bold uppercase">Xuất</p>
                                        <span
                                            class="min-w-28 text-center whitespace-nowrap bg-rose-100 text-rose-700 p-1 px-2 text-base font-bold rounded-full">
                                            {{ formatNumber($accessory->totalQtyOrderWithRow(), 2) }}<span class="text-sm">
                                                {{ $accessory->donvi }}</span>
                                        </span>
                                    </div>
                                    <div class="flex flex-col items-center justify-center w-1/3">
                                        <p class="font-bold uppercase">Tồn</p>
                                        <span
                                            class="min-w-28 text-center whitespace-nowrap bg-sky-100 text-sky-700 p-1 px-2 text-base font-bold rounded-full">
                                            {{ formatNumber($accessory->totalQtyWithRow() - $accessory->totalQtyOrderWithRow(), 2) }}<span
                                                class="text-sm"> {{ $accessory->donvi }}</span>
                                        </span>
                                    </div>
                                </div>
                                <div class="flex justify-between p-2">
                                    <div class="w-1/3 flex justify-center font-semibold text-base items-end">
                                        <img src="{{ asset('images/thread.svg') }}" title="Loại" alt="Loại"
                                            class="w-8">
                                        <a class="underline ml-2" href="{{ route('accessory.type', $accessory) }}">
                                            {{ $accessory->loai }}
                                        </a>
                                    </div>
                                    <div class="w-1/3 flex justify-center font-semibold text-base items-end">
                                        <img src="{{ asset('images/size.svg') }}" alt="Loại" class="w-8">
                                        <span class="ml-2">{{ $accessory->size }}</span>
                                    </div>
                                    <div class="w-1/3 flex justify-center font-semibold text-base items-end">
                                        <img src="{{ asset('images/color.svg') }}" title="Màu" alt="Màu"
                                            class="w-8">
                                        <span class="ml-2">{{ $accessory->mau }}</span>
                                    </div>
                                </div>
                                {{-- <div class="flex justify-between mt-2">
                                    <div class="w-1/2 flex justify-center gap-2 font-semibold text-base items-end">
                                        <img src="{{ asset('images/brand.svg') }}" alt="Loại" class="w-8">
                                        <span>{{ $accessory->khachhang }}</span>
                                    </div>
                                    <div class="w-1/2 flex justify-center gap-2 font-semibold text-base items-end">
                                        <img src="{{ asset('images/shirt.svg') }}" alt="Loại" class="w-8">
                                        <a class="underline" href="{{ route('accessory.style', $accessory->mahang) }}">
                                            #{{ $accessory->mahang }}
                                        </a>
                                    </div>
                                </div> --}}
                            </div>

                        </div>
                    @endforeach
                </div>

            </div>
            {{-- <table class="hidden uppercase w-full text-base text-center">
                <thead class="text-white uppercase bg-blue-500">
                    <tr>
                        <th class="border">
                            NGÀY NHẬP
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
                            TỒN
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($accessories as $accessory)
                        <tr class="test-sm bg-gray-50 hover:bg-gray-200 border-b">
                            <td title="id-{{ $accessory->id }}" class="border py-2 px-1 border-black">
                                {{ formatDate($accessory->ngay, 'd-m-Y') }}
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

                            <td
                                class="w-20 underline text-sm bg-green-700 text-green-200 whitespace-nowrap border border-black">
                                <a
                                    href="{{ route('accessory.add', $accessory->id) }}">{{ formatNumber($accessory->soluong) }}</a>
                            </td>


                            <td class="w-20 text-sm border border-black  bg-red-700 text-red-200 whitespace-nowrap">
                                <a class="underline"
                                    href="{{ route('accessory.order', $accessory->id) }}">{{ formatNumber($accessory->ordersQty(), 2) }}</a>
                            </td>

                            <td class="w-20 text-sm border-r text-white bg-sky-700 py-2 px-1 whitespace-nowrap">
                                {{ formatNumber($accessory->soluong - $accessory->ordersQty(), 2) }}
                            </td>

                        </tr>
                    @endforeach


                </tbody>
            </table> --}}

        </div>
    @endsection
