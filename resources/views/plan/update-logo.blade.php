@extends('layouts.app')
@section('content')
    <div class="min-h-screen flex flex-col">
        <div id="header" class="flex items-center px-2 py-1 bg-blue-500 text-white">
            <a href="{{ route('produce.dashboard') }}" class="w-10">
                <img src="{{ asset('images/logo.png') }}" alt="Logo">
            </a>
            <div class="flex items-center gap-4 flex-1 justify-center">
                <h1 class="text-center text-2xl uppercase font-bold">CẬP NHẬT THÔNG TIN {{ $plan->chuyen }}
                </h1>
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
            </div>
            <form id="formUpload" method="POST" action="{{ route('plan.storeLogo', $plan) }}"
                enctype="multipart/form-data">
                @csrf
                <input type="file" name="logo">
                @isset($files)
                    <div class="flex flex-wrap gap-1">
                        @foreach ($files as $file)
                            <div>
                                <input type="radio" name="newImage" value="{{ str_replace('public/', '', $file) }}">
                                <img src="{{ asset(str_replace('public', 'storage', $file)) }}" alt="" width="100">
                            </div>
                        @endforeach
                    </div>
                @endisset
                <button type="submit"
                    class="mt-2 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">
                    Cập nhật
                </button>
            </form>

        </div>
    </div>
@endsection
