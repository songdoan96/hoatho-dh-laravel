@extends('layouts.app')
@section('title', 'Báo cáo chất lượng hàng ngày')
@push('meta')
    <meta http-equiv="refresh" content="300">
@endpush
@push('styles')
    <style>
        tr td {
            min-width: 54px;
        }
    </style>
@endpush
@section('content')
    <div class="lg:p-0 w-full grid">
        <div id="header" class="relative h-fit w-full left-0 right-0 flex items-center px-2 py-1 bg-blue-500 text-white">
            <a href="{{ route('produce.dashboard') }}" class="w-10">
                <img src="{{ asset('images/logo.png') }}" alt="Logo">
            </a>
            <div class="flex items-center justify-center w-full gap-4">
                <h1 class="text-2xl uppercase font-bold">BÁO CÁO CHẤT LƯỢNG HÀNG NGÀY</h1>
                @if (!after17h())
                    <a href="{{ route('kcs.add') }}">
                        <img src="{{ asset('images/plus.png') }}" alt="xn1" width="35">
                    </a>
                    <a class="hidden" href="{{ route('kcs.add', ['xn' => 1]) }}">
                        <img src="{{ asset('images/xn1.png') }}" alt="xn1" width="40">
                    </a>
                    <a class="hidden" href="{{ route('kcs.add', ['xn' => 2]) }}">
                        <img src="{{ asset('images/xn2.png') }}" alt="xn2" width="40">
                    </a>
                @endif
                @if (Auth::check() && after8h())
                    <a href="{{ route('plan.download', Request::get('ngay') ?? date('Y-m-d')) }}" title="File báo cáo"
                        class="w-8">
                        <img src="{{ asset('images/file.png') }}" alt="Xóa">
                    </a>
                @endif
            </div>
            <div class="text-black hidden lg:block">
                <form class="max-w-[8rem]">
                    <input name="ngay" onchange="this.form.submit()" type="date" id="date"
                        class="bg-gray-50 border leading-none border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        max="{{ date('Y-m-d') }}" required />
                </form>
            </div>
        </div>
        @if (count($kcsData))
            <div class="relative">
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
                                BTP cấp
                            </th>
                            <th class="border">
                                Vốn
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
                                    <a href="{{ route('kcs.editYesterday', $kc) }}">
                                        {{ formatNumber($kc->thuchien) }}
                                    </a>
                                </td>
                                <td class="border">
                                    {{ formatNumber($kc->nhaphoanthanh) }}
                                </td>
                                @if ($kc->thuchien - $kc->nhaphoanthanh > 0)
                                    <td class="border bg-red-300">
                                        {{ formatNumber($kc->thuchien - $kc->nhaphoanthanh) }}
                                    </td>
                                @else
                                    <td class="border bg-green-300">
                                        {{ formatNumber($kc->thuchien - $kc->nhaphoanthanh) }}
                                    </td>
                                @endif
                                <td class="border">
                                    {{ formatNumber($kc->plans->btp_day->where('ngay', '<=', $kc->ngaytao)->sum('slcap')) }}
                                </td>
                                <td class="border">
                                    @php $von = abs(($kc->plans->btp_day->sum('slcap') - $kc->plans->nhaphoanthanh) / $kc->chitieungay); @endphp
                                    {{ formatNumber($von, 1) }}
                                </td>
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
                                        {{ formatNumber($tlthuchien, 1) }}%
                                    </td>
                                @else
                                    <td class="border bg-red-300">
                                        {{ formatNumber($tlthuchien, 1) }}%
                                    </td>
                                @endif

                                <td class="border">
                                    <a class="underline" href="{{ route('kcs.editPassFail', $kc) }}">
                                        {{ $kc->slloi }}
                                    </a>
                                </td>
                                @if ($kc->sldat == 0 && $kc->slloi == 0)
                                    <td class="border bg-green-500">0%</td>
                                @elseif(($kc->slloi / ($kc->sldat + $kc->slloi)) * 100 >= 10)
                                    <td class="border bg-red-300">
                                        {{ formatNumber(($kc->slloi / ($kc->sldat + $kc->slloi)) * 100, 1) }}%</td>
                                @else
                                    <td class="border bg-green-500">
                                        {{-- {{ round(($kc->slloi / ($kc->sldat + $kc->slloi)) * 100, 1) }}%</td> --}}
                                        {{ formatNumber(($kc->slloi / ($kc->sldat + $kc->slloi)) * 100, 1) }}%</td>
                                @endif

                                <td class="border text-left" style="min-width: 200px">
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
