<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    {{-- <meta name="viewport" content="width=device-width, initial-scale=1"> --}}
    @stack('meta')

    <title>@yield('title', 'Tổ cắt Hòa Thọ Đông Hà')</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('images/logo.png') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>

<body>
    <div class="min-h-screen flex flex-col bg-white">
        <div id="header" class="flex items-center px-2 py-1 bg-blue-500 text-white">
            <a href="{{ route('cutting.dashboard') }}">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-12">
            </a>
            <h1 class="text-center text-2xl uppercase font-bold w-full">@yield('header-title', 'QUẢN LÝ XUẤT NHẬP PHỤ LIỆU')</h1>
        </div>
        @yield('content')
    </div>
    @stack('scripts')
    @session('success')
        <div id="success" class="fixed z-50 bottom-2 right-2">
            <div id="success-toast"
                class="flex items-center w-full max-w-xs p-4 gap-2 text-white bg-green-500 rounded-lg shadow dark:text-gray-400 dark:bg-gray-800"
                role="alert">
                <div class="text-sm font-bold"> {{ session('success') }}</div>
            </div>
            {{ Session::forget('success') }}
        </div>
    @endsession
    @session('danger')
        <div id="danger" class="fixed z-50 bottom-2 right-2">
            <div id="danger-toast"
                class="flex items-center w-full max-w-xs p-4 gap-2 text-white bg-red-500 rounded-lg shadow dark:text-gray-400 dark:bg-gray-800"
                role="alert">
                <div class="text-sm font-bold"> {{ session('danger') }}</div>
            </div>
            {{ Session::forget('danger') }}
        </div>
    @endsession

</body>

</html>
