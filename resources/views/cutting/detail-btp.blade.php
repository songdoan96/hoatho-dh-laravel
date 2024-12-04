@extends('layouts.cutting')
@section('header-title', 'CHI TIẾT CẤP BÁN THÀNH PHẨM CHUYỀN ' . $btp->plan->chuyen)
@section('content')
    <a href="{{ route('cutting.editBtp', $btp->plan->id) }}">
        <img src="{{ asset('images/back.png') }}" alt="" class="w-8 absolute right-4 top-2 transition hover:scale-125">
    </a>
    @php
        $slcat = $btp->btpDay->sum('slcat');
        $slcap = $btp->btpDay->sum('slcap');
        $slcatPercent = $slcat / $btp->slkh;
        $slcapPercent = $slcap / $btp->slkh;
    @endphp
    <div class="flex w-1/2 mx-auto items-center justify-center mt-2">
        <div class="flex flex-col w-1/2 items-center justify-center">
            <div class="relative size-28">
                <svg class="size-full -rotate-90" viewBox="0 0 36 36" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="18" cy="18" r="16" fill="none"
                        class="stroke-current text-gray-200 dark:text-neutral-700" stroke-width="2"></circle>
                    <circle cx="18" cy="18" r="16" fill="none"
                        class="stroke-current text-green-600 dark:text-green-500" stroke-width="2" stroke-dasharray="100"
                        stroke-dashoffset="{{ 100 - $slcatPercent * 100 }}" stroke-linecap="round"></circle>
                </svg>

                <div class="absolute top-1/2 start-1/2 transform -translate-y-1/2 -translate-x-1/2">
                    <span class="text-center text-xl font-bold text-green-600 dark:text-green-500">
                        {{ round($slcatPercent * 100, 1) }}%
                    </span>
                </div>

            </div>
            <span class="uppercase font-bold">BTP cắt : {{ $slcat }}/{{ $btp->slkh }}</span>
        </div>
        <div class="flex flex-col w-1/2 items-center justify-center">
            <div class="relative size-28">
                <svg class="size-full -rotate-90" viewBox="0 0 36 36" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="18" cy="18" r="16" fill="none"
                        class="stroke-current text-gray-200 dark:text-neutral-700" stroke-width="2"></circle>
                    <circle cx="18" cy="18" r="16" fill="none"
                        class="stroke-current text-red-600 dark:text-red-500" stroke-width="2" stroke-dasharray="100"
                        stroke-dashoffset="{{ 100 - $slcapPercent * 100 }}" stroke-linecap="round"></circle>
                </svg>

                <div class="absolute top-1/2 start-1/2 transform -translate-y-1/2 -translate-x-1/2">
                    <span class="text-center text-xl font-bold text-red-600 dark:text-red-500">
                        {{ round($slcapPercent * 100, 1) }}%
                    </span>
                </div>

            </div>
            <span class="uppercase font-bold">BTP cấp : {{ $slcap }}/{{ $btp->slkh }}</span>
        </div>
    </div>

    <div class="relative overflow-x-auto h-full">
        <table class="w-3/5 mt-4 mx-auto text-center rtl:text-right text-gray-500 rounded shadow">
            <thead class="text-xs text-white uppercase bg-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Chuyền
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Ngày
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Size
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Màu
                    </th>
                    <th scope="col" class="px-6 py-3">
                        SL cắt
                    </th>
                    <th scope="col" class="px-6 py-3">
                        SL cấp
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($btpsDay as $btpDay)
                    <tr class="bg-gray-100 border-b hover:bg-gray-50">
                        <td class="px-6 py-1 border font-bold">
                            {{ $btp->plan->chuyen }}
                        </td>
                        <td scope="row" class="px-6 py-1 border font-medium text-gray-900 whitespace-nowrap">
                            {{ formatDate($btpDay->ngay, 'd-m-Y') }}
                        </td>
                        <td class="px-6 py-1 border">
                            {{ $btp->size }}
                        </td>
                        <td class="px-6 py-1 border">
                            {{ $btp->color }}
                        </td>
                        <td class="px-6 py-1 border">
                            {{ $btpDay->slcat }}
                        </td>
                        <td class="px-6 py-1 border">
                            {{ $btpDay->slcap }}
                        </td>
                    </tr>
                @endforeach

                <tr class="text-white uppercase bg-gray-400 font-bold">
                    <td class="px-6 py-1 border text-center" colspan="4">
                        Tổng
                    </td>
                    <td class="px-6 py-1 border">
                        {{ $btp->btpDay->sum('slcat') }}
                    </td>
                    <td class="px-6 py-1 border">
                        {{ $btp->btpDay->sum('slcap') }}
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection
