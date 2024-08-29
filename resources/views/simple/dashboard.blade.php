@extends('layouts.app')

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
    <div class="min-h-screen bg-primary">
        <div id="header" class="px-2 py-1 flex items-center bg-blue-500 text-white justify-between shadow-lg">
            <a href="{{ route('simple.index') }}">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-10">
            </a>
            @if (Request::get('tuan') && count($simples))
                <h1 class="text-center text-2xl uppercase font-bold">Báo cáo theo dõi mẫu {{ $simples[0]->tuan }}<a
                        href="{{ route('simple.add') }}" title="Thêm mẫu" class="mx-4"><i class="fa-solid fa-plus"></i></a>
                    <a href="{{ route('simple.download', ['tuan' => $simples[0]->tuan]) }}"><i
                            class="fa-solid fa-file-arrow-down"></i></a>
                </h1>
            @else
                <h1 class="text-center text-2xl uppercase font-bold">Theo dõi kế hoạch may mẫu và đồng bộ NPL <a
                        href="{{ route('simple.add') }}" title="Thêm mẫu" class="mx-4"><i
                            class="fa-solid fa-plus"></i></a>
                    <a href="{{ route('simple.download', ['tuan' => 'all']) }}"><i
                            class="fa-solid fa-file-arrow-down"></i></a>
                </h1>
            @endif

            <form method="get" class="w-lg" style="width: calc(100% / 6);">
                <div class="relative">
                    <input type="text" name="tuan" id="default-search"
                        class="block w-full py-2 ps-2 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Tìm theo tuần: T1-8,..." required />
                    <button type="submit"
                        class="text-white absolute end-[1px] bottom-[1px] bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                </div>
            </form>
        </div>
        <div id="dashboard">
            <div class="relative overflow-x-auto">
                @if (count($simples))
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
                                <th class="border border-black" rowspan="2">NGÀY MAY</th>
                                <th class="border border-black" rowspan="2">NGÀY HẸN</th>
                                <th class="border border-black" rowspan="2">NGÀY GỬI</th>
                                <th class="border border-black" rowspan="2">SỐ NGÀY MAY</th>
                                <th class="border border-black" rowspan="2">TÌNH TRẠNG</th>
                                <th class="border border-black" rowspan="2">KẾT QUẢ</th>
                                <th class="border border-black" rowspan="2">TUẦN</th>
                                <th class="border border-black" rowspan="2">BIÊN BẢN</th>

                                <th class="border border-black" rowspan="2">Ngày comment</th>
                                <th class="border border-black" rowspan="2">Ngày gửi lại</th>
                                <th class="border border-black" rowspan="2">Thay đổi khi may</th>
                                <th class="border border-black" rowspan="2">SL,Màu trả lại</th>

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
                                <tr $wire:key="{{ $simple->id }}" class="border-b bg-primary border-gray-700">
                                    <td class="group">
                                        {{ $loop->index + 1 }}.{{ $simple->khachhang }}
                                        <form method="post" action="{{ route('simple.destroy', $simple) }}"
                                            class="hidden group-hover:inline text-red-500 text-xl">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" name="delete-id" value="{{ $simple->id }}">
                                            <button title="Xóa dòng" type="submit"
                                                onclick="return confirm('Xác nhận xóa dòng này?')"
                                                name="delete-mau">&times;</button>
                                        </form>
                                    </td>
                                    <td>
                                        <a title="Chỉnh sửa" href="{{ route('simple.edit', $simple) }}" class="underline">
                                            <p class="w-20">
                                                {{ $simple->mahang }}
                                            </p>
                                        </a>
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
                                        {{ $simple->ktmay }}
                                    </td>
                                    <td>
                                        {{ $simple->kcs }}
                                    </td>
                                    <td>
                                        {{ $simple->ngaymay ? formatDate($simple->ngaymay, 'd-m') : '--' }}
                                    </td>
                                    <td>
                                        {{ $simple->ngayhen ? formatDate($simple->ngayhen, 'd-m') : '--' }}
                                    </td>
                                    <td>
                                        {{ $simple->ngaygui ? formatDate($simple->ngaygui, 'd-m') : '--' }}
                                    </td>
                                    <td>
                                        @php
                                            if ($simple->ngaygui && $simple->ngaymay) {
                                                $date1 = new DateTime($simple->ngaygui);
                                                $date2 = new DateTime($simple->ngaymay);
                                                $diff = $date1->diff($date2);
                                                echo $diff->d;
                                            } else {
                                                echo '--';
                                            }
                                        @endphp
                                    </td>
                                    <td>
                                        @php
                                            $today = date('Y-m-d');
                                            $henGuiDate = $simple->hengui;
                                        @endphp
                                        @if ($simple->tinhtrang === 'dagui')
                                            <p class="min-w-16 py-1 font-bold rounded-sm bg-green-500 text-white">Đã gửi
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
                                    <td>
                                        <?php
                                        $tuan = $simple->tuan;
                                        $parts = explode('-', $tuan);
                                        if (isset($parts[0]) && isset($parts[1])) {
                                            $res = $parts[0] . '-' . $parts[1];
                                            echo $res;
                                        } else {
                                            echo '--';
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?= $simple->bienban === 0 ? '&#10006;' : '&#10004;' ?>
                                    </td>

                                    <td>
                                        {{ $simple->ngaycmt ? formatDate($simple->ngaycmt, 'd-m') : '--' }}
                                    </td>
                                    <td>
                                        {{ $simple->ngayguilai ? formatDate($simple->ngayguilai, 'd-m') : '--' }}
                                    </td>
                                    <td>{{ $simple->thaydoi }}</td>
                                    <td>{{ $simple->tralaiinfo }}</td>
                                    <td>
                                        <p class="w-36">
                                            {{ $simple->ghichu }}
                                        </p>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <h1 class="text-center mt-4 uppercase font-bold">Không tìm thấy mẫu</h1>
                @endif
            </div>
        </div>
    </div>
@endsection
