@extends('layouts.app')
@push('meta')
    <meta http-equiv="refresh" content="300">
@endpush
@push('styles')
    <style>
        tr td {
            width: calc(100% / 16);
        }
    </style>
@endpush
@section('content')
    <div class="min-h-screen flex flex-col">
        <div id="header" class="flex items-center px-2 py-1 bg-blue-500 text-white">
            <a href="{{ route('produce.dashboard') }}" class="w-10">
                <img src="{{ asset('images/logo.png') }}" alt="Logo">
            </a>
            <div class="flex items-center justify-center w-full gap-4">
                <h1 class="text-2xl uppercase font-bold">BÁO CÁO CHẤT LƯỢNG HÀNG NGÀY</h1>
                @if (before8h())
                    <a href="{{ route('kcs.add', ['xn' => 1]) }}">
                        <img src="{{ asset('images/xn1.png') }}" alt="xn1" width="40">
                    </a>
                    <a href="{{ route('kcs.add', ['xn' => 2]) }}">
                        <img src="{{ asset('images/xn2.png') }}" alt="xn2" width="40">
                    </a>
                @endif
            </div>
            <div class="text-black">
                <form class="max-w-[8rem]">
                    <input name="ngay" onchange="this.form.submit()" type="date" id="date"
                        class="bg-gray-50 border leading-none border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        max="{{ date('Y-m-d') }}" required />
                </form>
            </div>
        </div>
        @if (count($kcsData))
            <div class="relative overflow-x-auto">
                <table class="w-full text-base text-center text-black border">
                    <thead class=" font-bold uppercase bg-blue-500 text-white">
                        <tr>
                            <th class="border">
                                Ngày
                            </th>
                            <th class="border">
                                Chuyền
                            </th>
                            <th class="border">
                                Khách hàng
                            </th>
                            <th class="border">
                                Mã hàng
                            </th>
                            <th class="border">
                                Lao động
                            </th>
                            <th class="border">
                                Dự phòng
                            </th>
                            <th class="border">
                                LK tác nghiệp
                            </th>
                            <th class="border">
                                LK thực hiện
                            </th>
                            <th class="border">
                                LK nhập hoàn thành
                            </th>
                            <th class="border">
                                Nhập thiếu
                            </th>
                            <th class="border">
                                Chỉ tiêu ngày
                            </th>
                            <th class="border">
                                SL đạt
                            </th>
                            <th class="border">
                                TL thực hiện
                            </th>
                            <th class="border">
                                SL lỗi
                            </th>
                            <th class="border">
                                TL lỗi
                            </th>
                            <th class="border">
                                Vốn
                            </th>
                            <th class="border">
                                Vướng mắc
                            </th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kcsData as $kc)
                            <tr class="">
                                <td class="border">
                                    {{ formatDate($kc->ngaytao, 'd-m') }}
                                </td>
                                <td class="p-1 border">
                                    <a href="{{ route('kcs.edit', $kc) }}"
                                        class="text-blue-600 text-2xl font-bold underline underline-offset-4">
                                        {{ $kc->plans->chuyen }}
                                    </a>
                                </td>
                                <td class="border">
                                    {{ $kc->plans->khachhang }}
                                </td>
                                <td class="border">
                                    {{ $kc->plans->mahang }}
                                </td>
                                <td class="border">
                                    {{ $kc->laodong }}
                                </td>
                                <td class="border">
                                    {{ $kc->duphong }}
                                </td>
                                <td class="border">
                                    {{ formatNumber($kc->plans->sltacnghiep) }}
                                </td>
                                <td class="border">
                                    {{ formatNumber($kc->plans->thuchien) }}
                                </td>
                                <td class="border">
                                    {{ formatNumber($kc->plans->nhaphoanthanh) }}
                                </td>
                                @if ($kc->plans->thuchien - $kc->plans->nhaphoanthanh > 0)
                                    <td class="border bg-red-300">
                                        {{ formatNumber($kc->plans->thuchien - $kc->plans->nhaphoanthanh) }}
                                    </td>
                                @else
                                    <td class="border bg-green-300">
                                        {{ formatNumber($kc->plans->thuchien - $kc->plans->nhaphoanthanh) }}
                                    </td>
                                @endif

                                <td class="border">
                                    {{ $kc->chitieungay }}
                                </td>
                                <td class="border">
                                    <a class="underline" href="{{ route('kcs.editPassFail', $kc) }}">
                                        {{ $kc->sldat }}
                                    </a>
                                </td>
                                @php
                                    $tlthuchien = ($kc->sldat / $kc->chitieungay) * 100;
                                @endphp
                                @if ($tlthuchien > 95)
                                    <td class="border bg-green-500">
                                        {{ round($tlthuchien, 2) }}%
                                    </td>
                                @else
                                    <td class="border bg-red-300">
                                        {{ round($tlthuchien, 2) }}%
                                    </td>
                                @endif

                                <td class="border">
                                    <a class="underline" href="{{ route('kcs.editPassFail', $kc) }}">
                                        {{ $kc->slloi }}
                                    </a>
                                </td>
                                @if ($kc->sldat == 0 && $kc->slloi == 0)
                                    <td class="border bg-red-300">0%</td>
                                @elseif(($kc->slloi / ($kc->sldat + $kc->slloi)) * 100 > 10)
                                    <td class="border bg-red-300">
                                        {{ round(($kc->slloi / ($kc->sldat + $kc->slloi)) * 100, 2) }}%</td>
                                @else
                                    <td class="border bg-green-500">
                                        {{ round(($kc->slloi / ($kc->sldat + $kc->slloi)) * 100, 2) }}%</td>
                                @endif
                                <td class="border">
                                    @php $von = abs(($kc->plans->btpcap - $kc->plans->nhaphoanthanh) / $kc->chitieungay); @endphp
                                    {{ round($von, 1) }}
                                </td>
                                <td class="border" style="min-width: 200px">
                                    {{ $kc->chitietloi }}
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        @endif

    </div>
@endsection
