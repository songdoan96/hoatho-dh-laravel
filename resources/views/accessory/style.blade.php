@extends('layouts.accessory')
@section('title', 'NHẬP KHO PHỤ LIỆU')
@section('header-title', "QUẢN LÝ XUẤT NHẬP MÃ HÀNG $mahang")

@section('content')

    <div class="relative overflow-x-auto">
        <div class="relative overflow-x-auto shadow-md">
            <table class="uppercase w-full text-base text-center">
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
                                    href="{{ route('accessory.add', $accessory->id) }}">{{ formatNumber($accessory->totalQtyWithStyle(), 2) }}</a>
                            </td>


                            <td class="w-20 text-sm border border-black  bg-red-700 text-red-200 whitespace-nowrap">
                                {{-- <a class="underline"
                                        href="{{ route('accessory.order', $accessory->id) }}">{{ formatNumber($accessory->totalQtyOrderWithStyle(), 2) }}</a> --}}
                                {{ formatNumber($accessory->totalQtyOrderWithStyle(), 2) }}
                            </td>

                            <td class="w-20 text-sm border-r text-white bg-sky-700 py-2 px-1 whitespace-nowrap">
                                {{ formatNumber($accessory->totalQtyWithStyle() - $accessory->totalQtyOrderWithStyle(), 2) }}
                            </td>

                        </tr>
                    @endforeach


                </tbody>
            </table>
        </div>


    </div>
@endsection
