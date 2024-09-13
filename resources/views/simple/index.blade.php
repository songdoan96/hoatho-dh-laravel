@extends('layouts.app')
@push('meta')
    <meta http-equiv="refresh" content="1800">
@endpush
@push('styles')
    <style>
        tbody td {
            border: 1px solid #787f99;
            text-align: center;
            min-width: 45px;
        }
    </style>
@endpush
@section('content')
    <div class="bg-primary text-textColor min-h-screen">

        <div class="flex items-center px-2 py-1 bg-blue-500 text-white">
            <a href="{{ route('simple.dashboard') }}" wire:navigate class="w-16"><img src="{{ asset('images/logo.png') }}"
                    alt="Logo" class="w-16"></a>
            <h1 class="text-center text-4xl uppercase font-bold w-full">Theo dõi kế hoạch may mẫu và đồng bộ NPL</h1>
        </div>
        <div class="">
            <div class="relative overflow-x-auto">
                <table class="w-full text-sm text-left rtl:text-right text-gray-300">
                    <thead class="text-xs uppercase bg-red-700 text-white text-center">
                        <tr>
                            <th class="border border-black" rowspan="2">KHÁCH HÀNG</th>
                            <th class="border border-black" rowspan="2">MÃ HÀNG</th>
                            <th class="border border-black" rowspan="2">LOẠI MẪU</th>
                            <th class="border border-black" rowspan="2">MÀU</th>
                            <th class="border border-black" rowspan="2">SIZE/DÀN</th>
                            <th class="border border-black" rowspan="2">SL</th>
                            <th class="border border-black" colspan="4">NGÀY DỰ KIẾN ĐỒNG BỘ</th>
                            <th class="border border-black" rowspan="2">KT MAY</th>
                            <th class="border border-black" rowspan="2">KC KIỂM</th>
                            <th class="border border-black" rowspan="2">NGÀY HẸN</th>
                            <th class="border border-black" rowspan="2">NGÀY GỬI</th>
                            <th class="border border-black" rowspan="2">TÌNH TRẠNG</th>
                            <th class="border border-black" rowspan="2">KẾT QUẢ</th>
                            <th class="border border-black" rowspan="2">GHI CHÚ</th>
                        </tr>
                        <tr>
                            <th class="border border-black">NPL</th>
                            <th class="border border-black">RẬP</th>
                            <th class="border border-black">TÀI LIỆU</th>
                            <th class="border border-black">MẪU GỐC</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($simples as $simple)
                            <tr class="border-b bg-primary border-gray-700">
                                <td>
                                    {{ $loop->index + 1 }}. {{ $simple->khachhang }}
                                </td>
                                <td>
                                    {{ $simple->mahang }}
                                </td>
                                <td>
                                    {{ $simple->loaimau }}
                                </td>
                                <td>
                                    {{ $simple->color }}
                                </td>
                                <td>
                                    {{ $simple->size }}
                                </td>
                                <td>
                                    {{ $simple->soluong }}
                                </td>
                                <td>
                                    {{ formatDate($simple->npl, 'd-m') }}
                                </td>
                                <td>
                                    {{ formatDate($simple->rap, 'd-m') }}
                                </td>
                                <td>
                                    {{ formatDate($simple->tailieu, 'd-m') }}
                                </td>
                                <td>
                                    {{ $simple->maugoc ? formatDate($simple->maugoc, 'd-m') : '--' }}
                                </td>
                                <td>
                                    <p class="line-clamp-2" title="{{ $simple->ktmay }}">{{ $simple->ktmay }}</p>
                                </td>
                                <td>
                                    {{ $simple->kcs }}
                                </td>
                                <td>
                                    {{ $simple->ngayhen ? formatDate($simple->ngayhen, 'd-m') : '--' }}
                                </td>
                                <td>
                                    {{ $simple->ngaygui ? formatDate($simple->ngaygui, 'd-m') : '--' }}
                                </td>
                                <td>
                                    @php
                                        $today = date('Y-m-d');
                                        $henGuiDate = $simple->ngayhen;
                                    @endphp
                                    @if ($simple->tinhtrang === 'dagui')
                                        <p class="min-w-16 py-1 font-bold rounded-sm bg-green-500 text-white">Đã gửi</p>
                                    @elseif($simple->tinhtrang === 'chomay')
                                        <p class="min-w-16 py-1 font-bold rounded-sm bg-orange-500 text-white">Chờ may
                                        </p>
                                    @elseif($today >= $henGuiDate)
                                        <p class="min-w-20 py-1 font-bold rounded-sm bg-red-500 text-white">Đang may</p>
                                    @else
                                        <p class="min-w-20 py-1 font-bold rounded-sm bg-blue-500 text-white">Đang may
                                        </p>
                                    @endif
                                </td>
                                <td>
                                    @if ($simple->ketqua === 'passed')
                                        <p class="p-1 font-bold rounded-sm bg-green-500 text-white">PASSED</p>
                                    @elseif($simple->ketqua === 'failed')
                                        <p class="p-1 font-bold rounded-sm bg-red-500 text-white">FAILED</p>
                                    @else
                                        <p class="flex items-center justify-center">--</p>
                                    @endif
                                </td>
                                <td>
                                    <p class="line-clamp-2" title="{{ $simple->ghichu }}">{{ $simple->ghichu }}</p>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>

        </div>
    </div>
@endsection
