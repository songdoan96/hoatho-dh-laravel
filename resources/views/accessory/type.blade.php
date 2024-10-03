@extends('layouts.accessory')
@section('title', 'QUẢN LÝ XUẤT NHẬP TỒN PHỤ LIỆU')
@section('title', "QUẢN LÝ XUẤT NHẬP TỒN MÃ HÀNG $accessory->mahang - LOẠI $accessory->loai")
@push('styles')
    <style>
        table th {
            min-width: 50px;
        }
    </style>
@endpush
@section('content')
    <div class="bg-gray-200">

        @if (count($accessories))
            <div class="relative overflow-x-auto">
                <div class="flex flex-col p-2">
                    <div class="flex uppercase gap-2 w-full">
                        <div class="flex flex-col bg-white p-2 rounded-lg w-1/6">
                            <div class="flex items-center gap-2">
                                <img class="w-10" src="{{ asset('images/brand.svg') }}" alt="">
                                <span class="font-bold text-xl">{{ $accessory->khachhang }}</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <img class="w-10" src="{{ asset('images/shirt.svg') }}" alt="">
                                <a class="underline font-bold text-xl" href="{{ route('accessory.style', $accessory) }}">
                                    #{{ $accessory->mahang }}
                                </a>
                            </div>
                        </div>
                        <div class="flex justify-center gap-2 lg:gap-8 bg-white p-2 rounded-lg w-5/12 lg:w-1/3 ">
                            <div class="flex items-center gap-2">
                                <img class="w-10" src="{{ asset('images/thread.svg') }}" title="Loại" alt="">
                                <a class="underline font-bold text-xl" href="{{ route('accessory.type', $accessory) }}">
                                    {{ $accessory->loai }}
                                </a>
                            </div>
                            <div class="flex items-center gap-2">
                                <img class="w-10" src="{{ asset('images/size.svg') }}" title="Size" alt="Size">
                                <span class="font-bold text-xl">{{ $accessory->size }}</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <img class="w-10" src="{{ asset('images/color.svg') }}" title="Màu" alt="Color">
                                <span class="font-bold text-xl">{{ $accessory->mau }}</span>
                            </div>
                        </div>
                        <div
                            class="flex justify-center gap-2 lg:gap-8 bg-white py-2 px=4 rounded-lg flex-1 font-bold text-xl">
                            <div class="flex flex-col items-center gap-2 ">
                                <span>SL nhập</span>
                                <span
                                    class="min-w-28 text-center whitespace-nowrap bg-emerald-100 text-emerald-700 p-1 px-2 rounded-full">{{ formatNumber($accessory->totalQtyWithStyle(), 2) }}<span
                                        class="text-sm"> {{ $accessory->donvi }}</span></span>
                            </div>

                            <div class="flex flex-col items-center gap-2 ">
                                <span>SL xuất</span>
                                @php
                                    $totalOrders = \App\Models\Accessory::where('order_id', $accessory->id)
                                        ->where('het', false)
                                        ->sum('soluong');

                                @endphp
                                <span
                                    class="min-w-28 text-center whitespace-nowrap bg-red-100 text-red-700 p-1 px-2 rounded-full">{{ formatNumber($totalOrders, 2) }}<span
                                        class="text-sm"> {{ $accessory->donvi }}</span></span>
                            </div>
                            <div class="flex flex-col items-center gap-2 ">
                                <span>SL tồn</span>
                                <span
                                    class="min-w-28 text-center whitespace-nowrap bg-sky-100 text-sky-700 p-1 px-2 rounded-full">{{ formatNumber($accessories[0]->totalQtyWithStyle() - $totalOrders, 2) }}<span
                                        class="text-sm"> {{ $accessory->donvi }}</span></span>
                            </div>

                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-4 mt-4 hidden">
                        @foreach ($accessories as $accessory)
                            <div class="bg-white text-sm">
                                <div class="grid grid-cols-9 w-full">
                                    <span class="text-center">Ngày</span>
                                    <span class="text-center">Dãy</span>
                                    <span class="text-center">PO</span>
                                    <span class="text-center">Nhập</span>
                                    <span class="text-center">Xuất</span>
                                    <span class="text-center">Tồn</span>
                                    <span class="text-center">Người nhận</span>
                                    <span class="text-center">Ghi chú</span>
                                    <span class="text-center"></span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="relative overflow-x-auto shadow-md">
                    <table class="uppercase w-full text-base text-center border">
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
                                    TỒN
                                </th>
                                <th class="border">
                                    NGƯỜI NHẬN
                                </th>
                                <th class="border">
                                    GHI CHÚ
                                </th>
                                <th class="border">

                                </th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($accessories as $accessory)
                                <tr data-id="{{ $accessory->id }}" class="test-sm bg-gray-50 hover:bg-gray-200 border-b">
                                    <td title="id={{ $accessory->id }}" class="border py-2 px-1 border-black">
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
                                        class="underline text-sm bg-green-700 text-green-200 whitespace-nowrap border border-black">
                                        <a
                                            href="{{ route('accessory.add', $accessory) }}">{{ formatNumber($accessory->soluong, 2) }}</a>
                                    </td>

                                    <td class="text-sm border border-black  bg-red-700 text-red-200 whitespace-nowrap">
                                        <a class="underline"
                                            href="{{ route('accessory.order', $accessory->id) }}">{{ formatNumber($accessory->ordersQty(), 2) }}</a>
                                    </td>
                                    <td class="w-20 text-sm border-r text-white bg-sky-700 py-2 px-1 whitespace-nowrap">
                                        {{ formatNumber($accessory->soluong - $accessory->ordersQty(), 2) }}
                                    </td>

                                    <td class="border py-2 px-1 border-black">
                                        {{ $accessory->nguoinhan }}
                                    </td>
                                    <td class="border py-2 px-1 border-black">
                                        {{ $accessory->ghichu }}
                                    </td>
                                    <td class="border py-2 px-1 border-black">
                                        <div class="flex gap-1 justify-end items-center">
                                            @if (count($accessory->orders))
                                                <button title="Chi tiết xuất" type="button"
                                                    class="btn-show-order w-5 transform hover:text-blue-500 transition hover:scale-125"
                                                    data-id="{{ $accessory->id }}">
                                                    <svg class="img-show" fill="none" viewBox="0 0 24 24"
                                                        stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                                        </path>
                                                    </svg>
                                                    <svg class="hidden img-hidden" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor">
                                                        <path
                                                            d="M2.99902 3L20.999 21M9.8433 9.91364C9.32066 10.4536 8.99902 11.1892 8.99902 12C8.99902 13.6569 10.3422 15 11.999 15C12.8215 15 13.5667 14.669 14.1086 14.133M6.49902 6.64715C4.59972 7.90034 3.15305 9.78394 2.45703 12C3.73128 16.0571 7.52159 19 11.9992 19C13.9881 19 15.8414 18.4194 17.3988 17.4184M10.999 5.04939C11.328 5.01673 11.6617 5 11.9992 5C16.4769 5 20.2672 7.94291 21.5414 12C21.2607 12.894 20.8577 13.7338 20.3522 14.5"
                                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round"></path>
                                                    </svg>
                                                </button>
                                            @endif
                                            <a href="{{ route('accessory.edit', $accessory) }}" title="Sửa phụ liệu"
                                                class="w-5 transform hover:text-green-500 transition hover:scale-125"
                                                data-id="283">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z">
                                                    </path>
                                                </svg>
                                            </a>
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

                                    </td>
                                </tr>
                                @if (count($accessory->orders))
                                    @foreach ($accessory->orders as $order)
                                        <tr item-id="{{ $order->id }}" parent-id="{{ $order->order_id }}"
                                            class="hidden order-child-{{ $order->order_id }} text-center bg-red-300 hover:bg-red-300/80 transition-colors duration-200">
                                            <td class="border py-2 px-1 border-black">
                                                {{ formatDate($order->ngay, 'd-m-Y') }}
                                            </td>
                                            <td class="border py-2 px-1 border-black"><a class="underline"
                                                    href="{{ route('accessory.row', $order->day) }}">{{ $order->day }}</a>

                                            </td>
                                            <td class="border py-2 px-1 border-black">{{ $order->khachhang }}
                                            </td>
                                            <td class="border py-2 px-1 border-black">
                                                <a class="underline" href="{{ route('accessory.style', $order) }}">
                                                    {{ $order->mahang }}
                                                </a>
                                            </td>
                                            <td class="border py-2 px-1 border-black">
                                                <a class="underline" href="{{ route('accessory.type', $order) }}">
                                                    {{ $order->loai }}
                                                </a>
                                            </td>
                                            <td class="border py-2 px-1 border-black">{{ $order->mau }}</td>
                                            <td class="border py-2 px-1 border-black">{{ $order->size }}</td>
                                            <td class="border py-2 px-1 border-black">{{ $order->donvi }}</td>
                                            <td class="border py-2 px-1 border-black">{{ $order->po }}</td>
                                            <td class="border py-2 px-1 border-black"></td>
                                            <td class="border py-2 px-1 border-black">{{ formatNumber($order->soluong) }}
                                            </td>
                                            <td class="border py-2 px-1 border-black"></td>
                                            <td class="border py-2 px-1 border-black">{{ $order->nguoinhan }}</td>
                                            <td class="border py-2 px-1 border-black">{{ $order->ghichu }}</td>


                                            <td class="border py-2 px-1 border-black">
                                                <div class="flex gap-1 justify-end items-center">
                                                    <a href="sua.php?id=294" title="Sửa phụ liệu"
                                                        class="hidden w-5 transform hover:text-green-500 transition hover:scale-125"
                                                        data-id="293">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z">
                                                            </path>
                                                        </svg>
                                                    </a>
                                                    <form id="form-delete"
                                                        action="{{ route('accessory.delete', $order) }}" method="post"
                                                        class="inline-block">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            onclick="return confirm('Xác nhận xóa phụ liệu này?')"
                                                            class="btn-show-modal w-5 transform hover:text-red-500 transition hover:scale-110">
                                                            <svg fill="none" viewBox="0 0 24 24"
                                                                stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                                </path>
                                                            </svg>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            @endforeach


                        </tbody>
                    </table>
                </div>

            </div>
        @endif
    </div>

@endsection
