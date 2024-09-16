@extends('layouts.app')

@push('meta')
    @if ($type === 'produce')
        <meta http-equiv="refresh" content="300;url={{ route('show', ['type' => 'kcs']) }}">
    @elseif($type === 'kcs')
        <meta http-equiv="refresh" content="300;url={{ route('show', ['type' => 'simple']) }}">
    @else
        <meta http-equiv="refresh" content="300;url={{ route('show', ['type' => 'produce']) }}">
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
                            <a href="{{ route('kcs.line', $plan->chuyen) }}"
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
                                        <span>LK thực hiện</span>
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
                            </a>
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
    @elseif($type === 'kcs')
        <div class="min-h-screen flex flex-col pt-10 lg:p-0">
            <div id="header" class="flex items-center px-2 py-1 bg-blue-500 text-white">
                <div class="w-10">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo">
                </div>
                <div class="flex items-center justify-center w-full gap-4">
                    <h1 class="text-2xl uppercase font-bold">BÁO CÁO CHẤT LƯỢNG HÀNG NGÀY</h1>
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
    @else
        <style>
            #simple tbody td {
                border: 1px solid #787f99;
                text-align: center;
                min-width: 70px;
            }
        </style>
        <div class="bg-primary text-textColor min-h-screen">
            <div id="header" class="flex items-center px-2 py-1 bg-blue-500 text-white">
                <div class="w-10">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo">
                </div>
                <div class="flex items-center justify-center w-full gap-4">
                    <h1 class="text-2xl uppercase font-bold">Theo dõi kế hoạch may mẫu và đồng bộ NPL</h1>
                </div>

            </div>
            <div>
                <div class="relative overflow-x-auto">
                    <table id="simple" class=" w-full text-xl text-left rtl:text-right text-gray-300">
                        <thead class="text-base uppercase bg-red-700 text-white text-center">
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
                                            <p class="min-w-16 py-1 font-bold rounded-sm bg-green-500 text-white">Đã gửi
                                            </p>
                                        @elseif($simple->tinhtrang === 'chomay')
                                            <p class="min-w-16 py-1 font-bold rounded-sm bg-orange-500 text-white">Chờ may
                                            </p>
                                        @elseif($today >= $henGuiDate)
                                            <p class="min-w-20 py-1 font-bold rounded-sm bg-red-500 text-white">Đang may
                                            </p>
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
                                    <td class="w-16">
                                        <p class="line-clamp-2" title="{{ $simple->ghichu }}">{{ $simple->ghichu }}</p>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    @endif

@endsection
