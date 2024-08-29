@extends('layouts.app')
@section('content')
    <div class="min-h-screen flex flex-col">
        <div id="header" class="flex items-center px-2 py-1 bg-blue-500 text-white">
            <a href="{{ route('produce.dashboard') }}" class="w-1/3">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-10">
            </a>
            <div class="flex items-center gap-4 w-2/3">
                <h1 class="text-2xl uppercase font-bold">BÁO CÁO CHẤT LƯỢNG HÀNG NGÀY</h1>
                <a href=""><img src="{{ asset('images/xn1.png') }}" alt="xn1" width="40"></a>
                <a href=""><img src="{{ asset('images/xn2.png') }}" alt="xn2" width="40"></a>
            </div>
        </div>







    </div>
@endsection
