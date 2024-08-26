<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    {{-- <meta name="viewport" content="width=device-width, initial-scale=1"> --}}
    @stack('meta')

    <title>@yield('title', 'Admin Đông Hà')</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('images/logo.png') }}">
    <link rel="stylesheet" href="{{ asset('fontawesome/css/all.css') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>

<body class="bg-primary text-textColor ">
    <div class="flex h-screen w-screen">
        <div class="w-1/6 p-2 border-r border-white">
            <ul class="underline">
                <li><a href="{{ route('admin.welcome') }}">Chào mừng</a></li>
            </ul>
        </div>
        <div class="w-5/6">
            @yield('content')
        </div>
    </div>
    @stack('scripts')
</body>

</html>
