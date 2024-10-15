@extends('layouts.app')
@section('content')
    <div class="min-h-screen flex flex-col">
        <div id="header" class="flex items-center px-2 py-1 bg-blue-500 text-white">
            <a href="{{ route('produce.dashboard') }}" class="w-10">
                <img src="{{ asset('images/logo.png') }}" alt="Logo">
            </a>
            <div class="flex items-center gap-4 flex-1 justify-center">
                <h1 class="text-center text-2xl uppercase font-bold">CẬP NHẬT THÔNG TIN LAO ĐỘNG - CHỈ TIÊU
                    (ngày {{ date('d-m-Y') }})</h1>
            </div>
        </div>
        <div class="w-full flex justify-center">
            <table>
                @foreach ($kcsAll as $kc)
                    <form method="POST" action="{{ route('kcs.updateWorker', $kc) }}" class="p-4 border">
                        @csrf
                        <tr class="hover:bg-gray-200">
                            <td class="px-2 py-1 border font-bold uppercase">Chuyền:</td>
                            <td class="px-2 py-1 border">{{ $kc->plans->chuyen }}</td>
                            <td class="px-2 py-1 border font-bold uppercase">Mã hàng:</td>
                            <td class="px-2 py-1 border">{{ $kc->plans->mahang }}</td>

                            <td class="px-2 py-1 border font-bold uppercase">Chỉ tiêu:</td>
                            <td class="px-2 py-1 border"><input required name="chitieungay"
                                    class="w-16 border px-2 border-blue-500" type="text" value="{{ $kc->chitieungay }}">
                            </td>
                            <td class="px-2 py-1 border font-bold uppercase">Lao động:</td>
                            <td class="px-2 py-1 border"><input name="laodong" class="w-16 border px-2 border-blue-500"
                                    type="text" value="{{ $kc->laodong }}">
                            </td>
                            <td class="px-2 py-1 border font-bold uppercase">Dự phòng:</td>
                            <td class="px-2 py-1 border"><input name="duphong" class="w-16 border px-2 border-blue-500"
                                    type="text" value="{{ $kc->duphong }}">
                            </td>
                            <td class="px-2 py-1 border"><button
                                    class="min-w-24 text-white bg-white-700 bg-blue-500 font-medium rounded-lg text-sm w-full sm:w-auto p-2 text-center"
                                    type="submit">Cập nhật</button></td>
                        </tr>
                    </form>
                @endforeach
            </table>

        </div>

    </div>
@endsection
