@extends('layouts.accessory')
@section('title', 'NHẬP KHO PHỤ LIỆU')
@section('header-title', "QUẢN LÝ XUẤT NHẬP TỒN KỆ $day")

@section('content')
    <div class="relative overflow-x-auto bg-gray-200 h-full flex-1 text-black">
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

                        </div>

                    </div>
                @endforeach
            </div>

        </div>
    </div>
@endsection
