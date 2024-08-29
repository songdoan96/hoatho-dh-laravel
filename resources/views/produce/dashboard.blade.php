@extends('layouts.app')
@section('content')
    <div class="min-h-screen flex flex-col">
        <div id="header" class="flex items-center px-2 py-1 bg-blue-500 text-white">
            <a href="{{ route('produce.dashboard') }}">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-10">
            </a>
            <h1 class="text-center text-2xl uppercase font-bold w-full">THEO DÕI SẢN XUẤT</h1>
        </div>

        @if (count($plans))
            <div class="p-4">
                <div class="grid grid-cols-4 gap-4">
                    @foreach ($plans as $plan)
                        <a href="#"
                            class="max-w-sm bg-white border border-gray-200 rounded-lg shadow font-semibold hover:bg-gray-100 text-gray-100 text-base flex flex-col gap-1">
                            <div class="flex gap-1 text-lg leading-5">
                                <div class="w-1/2 bg-blue-500 flex items-center justify-center">
                                    <p class="text-3xl">{{ $plan->chuyen }}</p>
                                </div>
                                <div class="w-1/2 bg-blue-500 flex flex-col items-center">
                                    <p>{{ $plan->khachhang }}</p>
                                    <p>{{ $plan->mahang }}</p>
                                </div>
                            </div>
                            <div class="bg-blue-500 p-2 flex flex-col">
                                <div class="flex justify-between">
                                    <span>Tác nghiệp</span>
                                    <span>{{ $plan->sltacnghiep }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span>LK thực hiện</span>
                                    <span>{{ $plan->thuchien }}</span>
                                </div>
                                <div class="flex justify-between items-center gap-1 mt-2">
                                    @php
                                        $thPercent = round(($plan->thuchien / $plan->sltacnghiep) * 100, 1);
                                    @endphp
                                    <span class="bg-white h-2 w-full relative">
                                        <span class="absolute h-2 left-0 right-4 bg-[#7cd79f]"
                                            style="width: {{ $thPercent }}%"></span>
                                    </span>
                                    <span class="w-[40px] h-full text-right text-sm">{{ $thPercent }}%
                                    </span>
                                </div>
                                <div class="flex text-base leading-5 justify-center my-2">
                                    <div class="w-1/2 bg-blue-500 flex flex-col items-center">
                                        <p>Nhập hthành</p>
                                        <p>{{ $plan->nhaphoanthanh }}</p>
                                    </div>
                                    <div class="w-1/2 bg-blue-500 flex flex-col items-center">
                                        <p>SL còn lại</p>
                                        <p>{{ $plan->sltacnghiep - $plan->thuchien }}</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>

            </div>
        @endif




    </div>
@endsection
