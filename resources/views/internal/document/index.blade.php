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
    <div class="min-h-screen bg-gray-200">
        <div id="header" class="px-2 py-1 flex items-center bg-blue-500 text-white justify-between shadow-lg">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-10">
            <div class="text-2xl uppercase font-bold flex flex-1 items-center justify-center gap-4">
                <h2>DANH MỤC TÀI LIỆU BAN HÀNH</h2>
                <a href="{{ route('internal.documentAdd') }}" title="Thêm tài liệu" class="w-8">
                    <img src="{{ asset('images/plus.png') }}" alt="Xóa">
                </a>
            </div>
        </div>
        <div id="dashboard">
            <div class="relative overflow-x-auto">
                @if (count($documents))
                    <table class="w-full text-sm text-left rtl:text-right text-black">
                        <thead class="text-xs uppercase bg-red-700 text-white text-center">
                            <tr>
                                <th class="border border-black py-2">BỘ PHẬN</th>
                                <th class="border border-black py-2">STT TỪNG BỘ PHẬN</th>
                                <th class="border border-black py-2">VĂN BẢN SỐ</th>
                                <th class="border border-black py-2">DANH MỤC</th>
                                <th class="border border-black py-2">GHI CHÚ</th>
                                <th class="border border-black py-2"></th>
                            </tr>


                        </thead>
                        <tbody>
                            @foreach ($documents as $document)
                                <tr class="border-b border-gray-700">
                                    <td class="group">
                                        {{ $document->bophan }}
                                        @auth
                                            <form action="{{ route('internal.documentDelete', $document) }}" method="post"
                                                class="hidden text-red-500 group-hover:inline-flex">
                                                @csrf
                                                @method('delete')
                                                <button onclick="return confirm('Xóa tài liệu này?')"
                                                    type="submit">&times;</button>
                                            </form>
                                        @endauth
                                    </td>
                                    <td>
                                        {{ $document->stt }}
                                    </td>
                                    <td>
                                        {{ $document->vanbanso }}
                                    </td>
                                    <td>
                                        {{ $document->danhmuc }}
                                    </td>
                                    <td>
                                        {{ $document->ghichu }}
                                    </td>
                                    <td class="py-4">
                                        <a class="bg-blue-500 text-white underline p-2 rounded"
                                            href="{{ route('internal.documentDownload', $document) }}">
                                            Tải xuống
                                        </a>
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <h1 class="text-center mt-4 uppercase font-bold">Không tìm tài liệu</h1>
                @endif
            </div>
        </div>
    </div>
@endsection
