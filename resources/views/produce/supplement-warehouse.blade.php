@extends('layouts.app')
@section('title', 'Cập nhật kế hoạch')

@section('content')
    <div class="min-h-screen flex flex-col">
        <div id="header" class="flex items-center px-2 py-1 bg-blue-500 text-white">
            <a href="{{ route('produce.finish') }}" class="w-10">
                <img src="{{ asset('images/logo.png') }}" alt="Logo">
            </a>
            <div class="flex items-center gap-4 flex-1 justify-center">
                <h1 class="text-center text-2xl uppercase font-bold">CẬP NHẬT THÔNG TIN {{ $plan->chuyen }}</h1>
            </div>
        </div>
        <div class="mx-auto w-full md:w-5/12 ">
            <div class="w-full text-xl text-black bg-gray-300 py-2 px-6 uppercase">
                <div class="flex"><span class="w-2/5 font-semibold">Khách hàng: </span><span>{{ $plan->khachhang }}</span>
                </div>
                <div class="flex"><span class="w-2/5 font-semibold">Mã hàng: </span><span>{{ $plan->mahang }}</span></div>
                <div class="flex"><span class="w-2/5 font-semibold">LK tác nghiệp:
                    </span><span>{{ $plan->sltacnghiep }}</span></div>
                <div class="flex"><span class="w-2/5 font-semibold">LK thực hiện:
                    </span><span>{{ $plan->thuchien }}</span></div>
                <div class="flex"><span class="w-2/5 font-semibold text-red-500">LK nhập h.thành:
                    </span><span>{{ $plan->nhaphoanthanh }}</span></div>
            </div>

            <form method="POST" action="{{ route('produce.supplementWarehouseUpdate', $plan) }}" class="p-4 border">
                <h2 class="text-center font-bold text-xl uppercase">HOÀN THÀNH CẬP NHẬT LŨY KẾ</h2>
                @csrf
                <div class="my-5 flex items-center gap-2">
                    <label for="nhaphoanthanh" class="font-medium w-1/3">LK nhập kho</label>
                    <input type="number" name="nhaphoanthanh" disabled value="{{ $plan->nhaphoanthanh }}"
                        class="flex-1 bg-gray-200 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5" />
                </div>
                <div class="my-5 flex items-center gap-2">
                    <label for="nhaphoanthanhthem" class="font-medium w-1/3">SL nhập thêm</label>
                    <input type="number" name="nhaphoanthanhthem" max="{{ $plan->thuchien - $plan->nhaphoanthanh }}"
                        class="flex-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5" />
                </div>
                <div class="flex justify-center gap-2">
                    <a href="{{ route('produce.finish') }}"
                        class="text-white bg-red-700 hover:bg-red-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center ">Hủy</a>
                    <button type="submit"
                        class="text-white bg-blue-700 hover:bg-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center ">
                        Cập nhật lũy kế
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
