@extends('layouts.app')
@section('content')
    <div class="min-h-screen flex flex-col">
        <div id="header" class="flex items-center px-2 py-1 bg-blue-500 text-white">
            <a href="{{ route('produce.dashboard') }}" class="w-10">
                <img src="{{ asset('images/logo.png') }}" alt="Logo">
            </a>
            <div class="flex items-center justify-center w-full gap-4">
                <h1 class="text-2xl uppercase font-bold">BÁO CÁO CHẤT LƯỢNG HÀNG NGÀY</h1>
                @if(!after8h())
                    <a href="{{route('kcs.add',['xn'=>1])}}">
                        <img src="{{ asset('images/xn1.png') }}" alt="xn1"
                             width="40">
                    </a>
                    <a href="{{route('kcs.add',['xn'=>2])}}">
                        <img src="{{ asset('images/xn2.png') }}" alt="xn2"
                             width="40">
                    </a>
                @endif
            </div>
        </div>
        @if (count($kcsData))
            <div class="relative overflow-x-auto">
                <table class="w-full text-base text-center text-black border">
                    <thead class=" font-bold text-gray-700 uppercase bg-blue-300">
                    <tr>
                        <th class="border w-20">
                            Ngày
                        </th>
                        <th class="border w-28">
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
                        <th class="border bg-red-200">
                            Nhập thiếu
                        </th>
                        <th class="border">
                            Chỉ tiêu ngày
                        </th>
                        <th class="border">
                            SL đạt
                        </th>
                        <th class="border bg-red-200">
                            TL thực hiện
                        </th>
                        <th class="border">
                            SL lỗi
                        </th>
                        <th class="border bg-red-200">
                            TL lỗi
                        </th>
                        <th class="border w-32">
                            Vướng mắc
                        </th>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($kcsData as $kc)
                        <tr
                            class="">
                            <td class="border">
                                {{ formatDate($kc->ngaytao ,"d-m")}}
                            </td>
                            <td
                                class="p-1 border">
                                <a href="{{route('kcs.edit',$kc)}}"
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
                                {{ formatNumber($kc->plans->thuchien )}}
                            </td>
                            <td class="border">
                                {{ formatNumber($kc->plans->nhaphoanthanh) }}
                            </td>
                            <td class="border bg-red-200">
                                {{ formatNumber($kc->plans->thuchien-$kc->plans->nhaphoanthanh) }}
                            </td>
                            <td class="border">
                                {{ $kc->chitieungay }}
                            </td>
                            <td class="border">
                                {{ $kc->sldat }}
                            </td>
                            <td class="border bg-red-200">
                                {{ round($kc->sldat / $kc->chitieungay * 100,2)  }}%
                            </td>
                            <td class="border">
                                {{ $kc->slloi }}
                            </td>
                            <td class="border bg-red-200">
                                @if($kc->sldat==0 && $kc->slloi==0)
                                    0%
                                @else
                                    {{ round($kc->slloi / ($kc->sldat + $kc->slloi) * 100 , 2)  }}%
                                @endif
                            </td>
                            <td class="border">
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
