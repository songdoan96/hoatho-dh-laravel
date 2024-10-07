@extends('layouts.app')
@section('content')
    <div class="min-h-screen flex flex-col">
        <div id="header" class="flex items-center px-2 py-1 bg-blue-500 text-white">
            <a href="{{ route('produce.dashboard') }}" class="w-10">
                <img src="{{ asset('images/logo.png') }}" alt="Logo">
            </a>
            <div class="flex items-center gap-4 flex-1 justify-center">
                <h1 class="text-center text-2xl uppercase font-bold">CẬP NHẬT THÔNG TIN THỰC HIỆN {{ $kcs->plans->chuyen }}
                </h1>
            </div>
        </div>
        <div class="mx-auto w-full md:w-5/12 ">
            <div class="w-full text-xl text-black bg-gray-300 py-2 px-6 uppercase">
                <div class="flex"><span class="w-3/5 font-semibold">Khách hàng:
                    </span><span>{{ $kcs->plans->khachhang }}</span>
                </div>
                <div class="flex"><span class="w-3/5 font-semibold">Mã hàng: </span><span>{{ $kcs->plans->mahang }}</span>
                </div>
                <div class="flex"><span class="w-3/5 font-semibold">LK tác nghiệp:
                    </span><span>{{ $kcs->plans->sltacnghiep }}</span></div>
                <div class="flex"><span class="w-3/5 font-semibold">LK thực hiện: <span
                            class="text-sm">({{ $kcs->ngaytao }})</span>
                    </span><span>{{ $kcs->plans->thuchien }}</span></div>
                <div class="flex"><span class="w-3/5 font-semibold">SL đạt: <span
                            class="text-sm">({{ $kcs->ngaytao }})</span>
                    </span><span>{{ $kcs->sldat }}</span></div>
            </div>
            <form method="POST" action="{{ route('kcs.editYesterdayUpdate', $kcs) }}" class="p-4 border">
                @csrf
                <div class="my-5 flex items-center gap-8">
                    <input type="hidden" name="id_before" value="{{ $kcsBefore->id }}">
                    <label for="qty_before" class="font-medium w-2/3">Thực hiện ({{ $kcsBefore->ngaytao }})</label>
                    <input type="number" id="qty_before" name="qty_before" min="0" required
                        class="flex-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5" />
                </div>

                <div class="flex justify-center gap-2">
                    <a href="javascript:history.back()"
                        class="text-white bg-red-700 hover:bg-red-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center ">
                        HỦY
                    </a>
                    <button type="submit"
                        class="text-white bg-blue-700 hover:bg-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center ">
                        CẬP NHẬT
                    </button>
                </div>
            </form>

        </div>
    </div>
@endsection
