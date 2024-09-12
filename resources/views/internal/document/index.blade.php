@extends('layouts.app')

@push('styles')
    <style>
        tbody td {
            border: 1px solid #787f99;
            padding-left: 4px;
        }
    </style>
@endpush
@section('content')
    <div class="min-h-screen bg-white">
        <div id="header" class="px-2 py-1 flex items-center bg-blue-500 text-white justify-between shadow-lg">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-10">
            <div class="text-2xl uppercase font-bold flex flex-1 items-center justify-center gap-4">
                <h2>DANH MỤC TÀI LIỆU BAN HÀNH</h2>
                <a href="{{ route('internal.documentAdd') }}" title="Thêm tài liệu" class="w-8">
                    <img src="{{ asset('images/plus.png') }}" alt="Thêm">
                </a>
            </div>
        </div>
        <div id="dashboard">
            <div class="relative overflow-x-auto">
                @if (count($documents))
                    <table class="w-full text-sm text-black">
                        <thead class="text-xs uppercase bg-red-700 text-white">
                            <tr>
                                <th class="border border-black py-2">BỘ PHẬN</th>
                                <th class="border border-black py-2">STT TỪNG BỘ PHẬN</th>
                                <th class="border border-black py-2">VĂN BẢN SỐ</th>
                                <th class="border border-black py-2">DANH MỤC</th>
                                <th class="border border-black py-2">Phân loại</th>
                                <th class="border border-black py-2">NGÀY BAN HÀNH LẦN ĐẦU</th>
                                <th class="border border-black py-2">NGÀY SĐ/ CẬP NHẬT</th>
                                <th class="border border-black py-2">LẦN SỬA ĐỔI</th>
                                <th class="border border-black py-2">THỜI GIAN LƯU TRỮ</th>
                                <th class="border border-black py-2">NƠI LƯU TRỮ HỒ SƠ</th>

                                <th class="border border-black py-2">GHI CHÚ</th>
                                <th class="border border-black py-2"></th>
                            </tr>


                        </thead>
                        <tbody>
                            @foreach ($documents as $document)
                                <tr class="border-b border-gray-700 text-left hover:bg-gray-200">
                                    <td class="group w-32">
                                        @auth
                                            <form action="{{ route('internal.documentDelete', $document) }}" method="post"
                                                class="hidden text-red-500 group-hover:inline-flex">
                                                @csrf
                                                @method('delete')
                                                <button class="text-xl" onclick="return confirm('Xóa tài liệu này?')"
                                                    type="submit">&times;</button>
                                            </form>
                                        @endauth
                                        {{ $document->bophan }}
                                        @auth
                                            <a title="Chỉnh sửa" href="{{ route('internal.documentEdit', $document) }}"
                                                class="text-xl text-blue-500 ml-2 hidden group-hover:inline-flex">&raquo;</a>
                                        @endauth
                                    </td>
                                    <td class="w-12">
                                        {{ $document->sttbophan }}
                                    </td>
                                    <td class="w-20">
                                        {{ $document->vanbanso }}
                                    </td>
                                    <td class="w-72">
                                        {{ $document->danhmuc }}
                                    </td>
                                    <td class="w-20">
                                        {{ $document->phanloai }}
                                    </td>
                                    <td class="w-20">
                                        {{ $document->ngaybanhanh }}
                                    </td>
                                    <td class="w-20">
                                        {{ $document->ngaysuadoi }}
                                    </td>
                                    <td class="w-12">
                                        {{ $document->lansuadoi }}
                                    </td>
                                    <td class="w-12">
                                        {{ $document->thoigianluu }}
                                    </td>
                                    <td class="w-28">
                                        {{ $document->noiluutru }}
                                    </td>
                                    <td>
                                        {{ $document->ghichu }}
                                    </td>
                                    <td class="w-28">
                                        @if ($document->link)
                                            <a title="{{ $document->link }}" class="underline p-2 rounded"
                                                href="{{ route('internal.documentDownload', $document) }}">
                                                Tải xuống
                                            </a>
                                        @else
                                            @if (Auth::check())
                                                <a title="{{ $document->link }}" class="underline p-2 rounded"
                                                    href="{{ route('internal.documentEdit', $document) }}">
                                                    Upload
                                                </a>
                                            @endif
                                        @endif

                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <h1 class="text-center mt-4 uppercase font-bold">Không tìm thấy tài liệu</h1>
                @endif
            </div>
        </div>
    </div>
@endsection
