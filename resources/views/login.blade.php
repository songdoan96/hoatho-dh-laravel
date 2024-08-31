@extends('layouts.app')
@section('content')
    <div class="h-screen w-full flex flex-col gap-4 p-4 items-center justify-center">
        <img src="{{ asset('images/logo2.png') }}" alt="Logo" width="300">
        <h1 class="uppercase text-2xl font-bold">Đăng nhập</h1>
        <form method="POST" action="{{ route('login.store') }}" class="w-full md:w-1/3 shadow-lg p-4 border">
            @csrf
            <div class="mb-5">
                <label for="username" class="block mb-2 text-sm font-medium ">Tài khoản</label>
                <input type="text" name="username" name="username" required
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                @error('username')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-5">
                <label for="password" class="block mb-2 text-sm font-medium">Mật khẩu</label>
                <input type="password" name="password" name="password" required
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                @error('password')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center ">Đăng
                nhập</button>
        </form>
    </div>
@endsection
