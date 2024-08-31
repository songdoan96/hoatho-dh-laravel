<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    {{-- <meta name="viewport" content="width=device-width, initial-scale=1"> --}}
    @stack('meta')

    <title>@yield('title', 'Hòa Thọ Đông Hà')</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('images/logo.png') }}">
    <link rel="stylesheet" href="{{ asset('fontawesome/css/all.css') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>

<body>
    @yield('content')
    @stack('scripts')
    @session('success')
    <div id="success" class="fixed z-50 bottom-2 right-2">
        <div id="success-toast"
             class="flex items-center w-full max-w-xs p-4 gap-2 text-white bg-green-500 rounded-lg shadow dark:text-gray-400 dark:bg-gray-800"
             role="alert">
            <div class="text-sm font-normal"> {{ session('success') }}</div>
        </div>
        {{ Session::forget('success') }}
    </div>
    @endsession
    @session('danger')
    <div id="danger" class="fixed z-50 bottom-2 right-2">
        <div id="danger-toast"
             class="flex items-center w-full max-w-xs p-4 gap-2 text-white bg-red-500 rounded-lg shadow dark:text-gray-400 dark:bg-gray-800"
             role="alert">
            <div class="text-sm font-normal"> {{ session('danger') }}</div>
        </div>
        {{ Session::forget('danger') }}
    </div>
    @endsession

</body>

</html>
