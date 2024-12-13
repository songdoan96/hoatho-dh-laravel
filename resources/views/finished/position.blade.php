@extends('layouts.finished')
@section('header-title', "Thông tin dãy $position")

@section('content')
    <div class="main p-2">
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>

                        <th scope="col" class="p-2 border">
                            KHÁCH HÀNG
                        </th>
                        <th scope="col" class="p-2 border">
                            MÃ HÀNG
                        </th>
                        <th scope="col" class="p-2 border">
                            PO
                        </th>
                        <th scope="col" class="p-2 border">
                            SIZE
                        </th>
                        <th scope="col" class="p-2 border">
                            MÀU
                        </th>
                        <th scope="col" class="p-2 border">
                            KẾ HOẠCH
                        </th>
                        <th scope="col" class="p-2 border">
                            ĐÃ NHẬP
                        </th>
                        <th scope="col" class="p-2 border">
                            ĐÃ ĐÓNG
                        </th>
                        <th scope="col" class="p-2 border">
                            PRE-FINAL
                        </th>
                        <th scope="col" class="p-2 border">
                            FINAL
                        </th>
                        <th scope="col" class="p-2 border">
                            NGÀY XUẤT
                        </th>
                        <th scope="col" class="p-2 border">
                            SỐ THÙNG
                        </th>
                        <th scope="col" class="p-2 border">
                            KÍCH THÙNG
                        </th>
                        <th scope="col" class="p-2 border">
                            SỐ KHỐI(m3)
                        </th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($finishes as $finish)
                        <tr class="bg-white border-b hover:bg-gray-50">
                            <td class="p-2 border">
                                {{ $finish->khachhang }}
                            </td>
                            <td class="p-2 border">
                                {{ $finish->mahang }}
                            </td>
                            <td class="p-2 border">
                                {{ $finish->po }}
                            </td>
                            <td class="p-2 border">
                                {{ $finish->size }}
                            </td>
                            <td class="p-2 border">
                                {{ $finish->mau }}
                            </td>
                            <td class="p-2 border">
                                {{ $finish->slkh }}
                            </td>
                            <td class="p-2 border">
                                {{ $finish->danhap }}
                            </td>
                            <td class="p-2 border">
                                {{ $finish->dadong }}
                            </td>
                            <td class="p-2 border">
                                {{ formatDate($finish->ngay_prefinal, 'd/m') }}
                                @if ($finish->prefinal == 0)
                                    --
                                @elseif($finish->prefinal == 1)
                                    <span class="bg-green-300 p-1 rounded font-bold">PASSED</span>
                                @else
                                    <span class="bg-red-300 p-1 rounded font-bold">FAILED</span>
                                @endif
                            </td>
                            <td class="p-2 border">
                                {{ formatDate($finish->ngay_final, 'd/m') }}
                                @if ($finish->final == 0)
                                    --
                                @elseif($finish->final == 1)
                                    <span class="bg-green-300 p-1 rounded font-bold">PASSED</span>
                                @else
                                    <span class="bg-red-300 p-1 rounded font-bold">FAILED</span>
                                @endif
                            </td>
                            <td class="p-2 border">
                                {{ formatDate($finish->ngay_xuat, 'd/m') }}
                            </td>
                            <td class="p-2 border">
                                {{ $finish->sothung }}
                            </td>
                            <td class="p-2 border">
                                {{ $finish->kichthung }}
                            </td>
                            <td class="p-2 border">
                                @php
                                    preg_match_all('/\d+/', $finish->kichthung, $matches);
                                    preg_match_all('/\d+/', $finish->sothung, $tongthung);
                                    $numbers = $matches[0];
                                    $thung = $tongthung[0];
                                    if ($numbers && $thung) {
                                        $num1 = $numbers[0];
                                        $num2 = $numbers[1];
                                        $num3 = $numbers[2];
                                        if (str_contains(strtoupper($finish->kichthung), 'CM')) {
                                            $cm = $num1 * $num2 * $num3 * 0.000001 * $thung[0];
                                            echo formatNumber($cm, 3);
                                        } else {
                                            $in = $num1 * $num2 * $num3 * (0.0254 * 0.0254 * 0.0254) * $thung[0];
                                            echo formatNumber($in, 3);
                                        }
                                    }
                                @endphp
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
