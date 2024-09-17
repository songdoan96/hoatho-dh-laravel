@extends('layouts.app')

@push('meta')
    @if ($type === 'produce')
        <meta http-equiv="refresh" content="300;url={{ route('show', ['type' => 'kcs']) }}">
    @else
        <meta http-equiv="refresh" content="300;url={{ route('show', ['type' => 'simple']) }}">
    @endif
    {{-- <meta name="viewport" content="width=device-width, initial-scale=1"> --}}
@endpush
@section('content')
    @if ($type === 'produce')
        <div class="min-h-screen flex flex-col">
            <div id="header" class="flex items-center px-2 py-1 bg-blue-500 text-white">
                <div class="w-10">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo">
                </div>
                <div class="flex items-center gap-4 flex-1 justify-center">
                    <h1 class="text-center text-2xl uppercase font-bold">THEO DÕI SẢN XUẤT</h1>
                </div>
            </div>
            @if (count($plans))
                <div class="p-4">
                    <div class="grid grid-cols-2 md:grid-cols-4 xl:grid-cols-5 2xl:grid-cols-5 gap-4">
                        @foreach ($plans as $plan)
                            <div
                                class="bg-white border border-black font-semibold text-gray-100 text-lg flex flex-col gap-1 overflow-hidden hover:scale-105 transition rounded">
                                <div class="flex gap-1 text-xl font-bold">
                                    <div class="w-1/2 bg-blue-600 flex items-center justify-center">
                                        <p class="text-3xl">{{ $plan->chuyen }}</p>
                                    </div>
                                    <div class="w-1/2 bg-blue-600 flex flex-col items-center">
                                        <p class="line-clamp-1">{{ $plan->khachhang }}</p>
                                        <p class="line-clamp-1">{{ $plan->mahang }}</p>
                                    </div>
                                </div>
                                <div class="bg-blue-600 p-2 flex flex-col">
                                    <div class="flex justify-between">
                                        <span>Tác nghiệp</span>
                                        <span>{{ formatNumber($plan->sltacnghiep) }} </span>
                                    </div>
                                    @php
                                        $thuchienPercent = round(($plan->thuchien / $plan->sltacnghiep) * 100, 1);
                                    @endphp
                                    <div class="flex justify-between">
                                        <span>Thực hiện</span>
                                        <span class="flex items-center gap-1">
                                            <span>{{ formatNumber($plan->thuchien) }}<span class="text-sm"> </span>
                                                @if ($thuchienPercent > 95)
                                                    <form action="{{ route('plan.planDone', $plan) }}" method="post"
                                                        class="inline-flex items-center justify-center">
                                                        @csrf
                                                        <button onclick="return confirm('Xác nhận kết thúc đơn hàng này?')"
                                                            class="inline-flex items-center justify-center"><img
                                                                src="{{ asset('images/alert.gif') }}" width="20"
                                                                alt="Sắp hết đơn hàng"></button>
                                                    </form>
                                                @endif
                                            </span>
                                        </span>
                                    </div>
                                    <div class="flex justify-between items-center gap-1 mt-2">

                                        <span class="bg-gray-100 h-3 w-full relative overflow-hidden">
                                            <span class="absolute h-full left-0 bg-[#7cd79f]"
                                                style="width: {{ $thuchienPercent }}%"></span>
                                            <span
                                                class="text-blue-900 absolute w-full h-full text-xs font-bold flex justify-center items-center">{{ $thuchienPercent }}
                                                %</span>
                                        </span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span>SL còn lại</span>
                                        <span>{{ formatNumber($plan->sltacnghiep - $plan->thuchien) }} <span
                                                class="text-sm"></span></span>
                                    </div>

                                    <div class="flex justify-between">
                                        <span>Nhập hoàn thành</span>
                                        <span>{{ formatNumber($plan->nhaphoanthanh) }} </span>
                                    </div>


                                </div>
                                @php
                                    $kcs = $plan->kcs->where('ngaytao', date('Y-m-d'))->first();
                                @endphp
                                <div class="bg-blue-600 p-2">
                                    <div class="flex justify-between">
                                        <span>Chỉ tiêu ngày</span>
                                        <span>{{ $kcs->chitieungay ?? '--' }} </span>
                                    </div>

                                    <div class="flex justify-between">
                                        <span>SP đạt / TL đạt</span>
                                        <span>{{ $kcs->sldat ?? '--' }}<span class="text-sm">pcs</span> /
                                            {{ $kcs ? round(($kcs->sldat / $kcs->chitieungay) * 100, 2) : '--' }} %</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span>SP lỗi / TL lỗi</span>
                                        @php
                                            $loiPercent = null;
                                            if (isset($kcs)) {
                                                if ($kcs->sldat == 0 && $kcs->slloi == 0) {
                                                    $loiPercent = 0;
                                                } else {
                                                    $loiPercent = round(
                                                        ($kcs->slloi / ($kcs->sldat + $kcs->slloi)) * 100,
                                                        2,
                                                    );
                                                }
                                            }
                                        @endphp
                                        <span>{{ $kcs->slloi ?? '--' }}<span class="text-sm">pcs</span> /
                                            {{ $loiPercent ?? '--' }}
                                            <span class="text-sm">%</span></span>
                                    </div>

                                </div>
                            </div>
                        @endforeach
                        @if (count($plansWaiting))
                            <div
                                class="bg-blue-600 p-2 border border-black text-gray-100 flex flex-col gap-1 overflow-hidden transition">
                                <h2 class="text-center uppercase text-lg font-bold">Đơn hàng chờ sản xuất</h2>
                                @foreach ($plansWaiting as $index => $plw)
                                    <p>- {{ $plw->chuyen }}:{{ $plw->mahang }}(
                                        {{ formatDate($plw->ngaydukien, 'd-m') }} )
                                    </p>
                                @endforeach
                            </div>
                        @endif

                    </div>

                </div>
            @endif


        </div>
    @else
        <div class="min-h-screen flex flex-col">
            <div id="header" class="flex items-center px-2 py-1 bg-blue-500 text-white">
                <div class="w-10">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo">
                </div>
                <div class="flex items-center justify-center w-full gap-4">
                    <h1 class="text-2xl uppercase font-bold">BÁO CÁO CHẤT LƯỢNG NGÀY {{ date('d/m/Y') }}
                    </h1>
                </div>

            </div>
            @if (count($kcsData))
                <style>
                    #kcs tbody th {
                        width: calc(100%/17);
                        text-align: left;
                    }

                    #kcs tbody td {
                        min-width: 80px;
                        text-align: center
                    }
                </style>
                <div class="relative overflow-x-auto">
                    <!-- component -->

                    <table id="kcs" class="w-full border">
                        <thead class="font-bold uppercase bg-blue-500 text-white">
                            <tr>
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
                                    tác nghiệp
                                </th>
                                <th class="border">
                                    thực hiện
                                </th>
                                <th class="border">
                                    nhập hoàn thành
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
                                <tr class="text-2xl h-20 font-bold">

                                    <td class="p-1 border">
                                        <div class="text-blue-600 font-bold">
                                            {{ $kc->plans->chuyen }}
                                        </div>
                                    </td>
                                    <td class="border">
                                        @if ($kc->plans->logo)
                                            <div class="flex justify-center items-center">
                                                <img src="{{ asset('storage/' . $kc->plans->logo) }}"
                                                    alt="{{ $kc->plans->khachhang }}" class="bg-cover h-full w-20 ">
                                            </div>
                                        @else
                                            {{ $kc->plans->khachhang }}
                                        @endif

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
                                        {{ formatNumber($kc->thuchien) }}
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
                                        {{ formatNumber($kc->btpcap) }}
                                    </td>
                                    <td class="border">
                                        @php $von = abs(($kc->plans->btpcap - $kc->plans->nhaphoanthanh) / $kc->chitieungay); @endphp
                                        {{ formatNumber($von, 1) }}
                                    </td>
                                    <td class="border">
                                        {{ $kc->chitieungay }}
                                    </td>
                                    <td class="border">
                                        <div>
                                            {{ $kc->sldat }}
                                        </div>
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
                                        <div>
                                            {{ $kc->slloi }}
                                        </div>
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

                                    <td class="border text-left" style="min-width: 200px;text-align: left">
                                        {{ $kc->chitietloi }}
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            @endif

        </div>


    @endif

@endsection
