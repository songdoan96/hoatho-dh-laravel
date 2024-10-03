@extends('layouts.accessory')
@section('title', 'NHẬP KHO PHỤ LIỆU')
@section('header-title', 'Phụ liệu đã hết')

@section('content')
    <div class="relative overflow-x-auto">
        <div class="relative overflow-x-auto shadow-md">
            <table class="uppercase w-full text-base text-center">
                <thead class="text-white uppercase bg-red-500">
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
                        <th class="border w-24">
                            NGƯỜI NHẬN
                        </th>
                        <th class="border">
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
                                {{-- <a class="underline" href="{{ route('accessory.row', $accessory->day) }}"> --}}
                                {{ $accessory->day }}
                                {{-- </a> --}}
                            </td>
                            <td class="border py-2 px-1 border-black">
                                {{ $accessory->khachhang }}
                            </td>
                            <td class="border py-2 px-1 border-black">
                                <a class="underline"
                                    href="{{ route('accessory.soldOut', ['mahang' => $accessory->mahang]) }}">
                                    {{ $accessory->mahang }}
                                </a>
                            </td>
                            <td class="border py-2 px-1 border-black">
                                <a class="underline"
                                    href="{{ route('accessory.soldOut', ['mahang' => $accessory->mahang, 'accessory' => $accessory]) }}">
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
                                    href="{{ route('accessory.add', $accessory->id) }}">{{ formatNumber($accessory->soluong, 2) }}</a>
                            </td>
                            <td class="border py-2 px-1 border-black">

                            </td>
                            <td class="border py-2 px-1 border-black">

                                <button title="Chi tiết xuất" type="button"
                                    class="btn-show-order w-5 transform hover:text-blue-500 transition hover:scale-125"
                                    data-id="{{ $accessory->id }}">
                                    <svg class="img-show" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                        </path>
                                    </svg>
                                    <svg class="hidden img-hidden" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                        <path
                                            d="M2.99902 3L20.999 21M9.8433 9.91364C9.32066 10.4536 8.99902 11.1892 8.99902 12C8.99902 13.6569 10.3422 15 11.999 15C12.8215 15 13.5667 14.669 14.1086 14.133M6.49902 6.64715C4.59972 7.90034 3.15305 9.78394 2.45703 12C3.73128 16.0571 7.52159 19 11.9992 19C13.9881 19 15.8414 18.4194 17.3988 17.4184M10.999 5.04939C11.328 5.01673 11.6617 5 11.9992 5C16.4769 5 20.2672 7.94291 21.5414 12C21.2607 12.894 20.8577 13.7338 20.3522 14.5"
                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round"></path>
                                    </svg>
                                </button>
                            </td>

                            {{-- <td class="w-20 text-sm border border-black  bg-red-700 text-red-200 whitespace-nowrap">
                                    {{ formatNumber($totalOrders, 2) }}
                                </td>

                                <td class="w-20 text-sm border-r text-white bg-sky-700 py-2 px-1 whitespace-nowrap">
                                    {{ formatNumber($accessory->totalQtyWithStyle() - $accessory->totalQtyOrderWithStyle(), 2) }}
                                </td> --}}

                        </tr>
                        @if (count($accessory->orders))
                            @foreach ($accessory->orders as $order)
                                <tr item-id="{{ $order->id }}" parent-id="{{ $order->order_id }}"
                                    class="hidden order-child-{{ $order->order_id }} text-center bg-red-300 hover:bg-red-300/80 transition-colors duration-200">
                                    <td class="border py-2 px-1 border-black">
                                        {{ formatDate($order->ngay, 'd-m-Y') }}
                                    </td>
                                    <td class="border py-2 px-1 border-black">
                                        {{ $order->day }}

                                    </td>
                                    <td class="border py-2 px-1 border-black">{{ $order->khachhang }}
                                    </td>
                                    <td class="border py-2 px-1 border-black">
                                        {{ $order->mahang }}
                                    </td>
                                    <td class="border py-2 px-1 border-black">
                                        {{ $order->loai }}
                                    </td>
                                    <td class="border py-2 px-1 border-black">{{ $order->mau }}</td>
                                    <td class="border py-2 px-1 border-black">{{ $order->size }}</td>
                                    <td class="border py-2 px-1 border-black">{{ $order->donvi }}</td>
                                    <td class="border py-2 px-1 border-black">{{ $order->po }}</td>
                                    <td class="border py-2 px-1 border-black">{{ formatNumber($order->soluong) }}
                                    </td>
                                    <td class="border py-2 px-1 border-black">{{ $order->nguoinhan }}</td>
                                    <td class="border py-2 px-1 border-black">{{ $order->ghichu }}</td>
                                </tr>
                            @endforeach
                        @endif
                    @endforeach


                </tbody>
            </table>
        </div>


    </div>
@endsection
