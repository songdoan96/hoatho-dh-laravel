<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    {{-- <meta name="viewport" content="width=device-width, initial-scale=1"> --}}
    @stack('meta')

    <title>@yield('title', 'Phụ liệu Hòa Thọ Đông Hà')</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('images/logo.png') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>

<body>
    <div class="min-h-screen flex flex-col bg-white">
        <div id="header" class="flex items-center px-2 py-1 bg-blue-500 text-white">
            <a href="{{ route('accessory.dashboard') }}">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-12">
            </a>
            <h1 class="text-center text-2xl uppercase font-bold w-full">@yield('header-title', 'QUẢN LÝ XUẤT NHẬP PHỤ LIỆU')</h1>

            <a href="{{ route('accessory.add') }}" title="Nhập kho" class="w-10">
                <img src="{{ asset('images/plus.png') }}" alt="Nhập kho">
            </a>
            <a href="{{ route('accessory.show') }}" title="TV" class="w-10 ml-2">
                <img src="{{ asset('images/tv.svg') }}" alt="TV">
            </a>
            <a href="{{ route('accessory.soldOut') }}" title="Phụ liệu hết"
                class="ml-2 bg-yellow-300 text-red-700 px-1 rounded uppercase font-bold">
                Hết
            </a>
            <form method="get" action="{{ route('accessory.dashboard') }}"
                class="hidden md:block relative h-8 md:w-64 lg:w-96 rounded text-black ml-2">
                {{-- @csrf --}}
                <select name="search_type" id="form-search-list"
                    class="absolute left-0 z-20 h-full border-r border-black outline-none text-sm bg-gray-200">
                    <option value="mahang">MÃ HÀNG</option>
                    <option value="type">PHỤ LIỆU</option>
                    {{-- <option value="po">PO</option> --}}
                </select>
                <input type="text" name="search_value" id="search-input"
                    class="absolute z-10 pl-28 outline-none w-full h-full px-2 py-1.5 bg-gray-200"
                    placeholder="Tìm kiếm...">
                <button type="submit" class="absolute right-0 z-20 py-2 px-3 border-l border-black h-full ">
                    <svg class="w-4 h-4" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"></path>
                    </svg>
                </button>
            </form>
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
