@extends('layouts.app')
@section('content')
    <section class="h-screen flex justify-center items-center">
        <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16 lg:px-6">
            <div class="mx-auto max-w-screen-sm text-center">
                <h1 class="mb-4 text-6xl tracking-tight font-extrabold lg:text-9xl text-blue-500">
                    404</h1>
                <p class="mb-4 text-lg font-light text-gray-400">Trang không tồn tại hoặc đã bị xóa</p>
                <a href="javascript:history.back()"
                    class="inline-flex text-white bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center focus:ring-blue-900 my-4">Quay
                    lại</a>
            </div>
        </div>
    </section>
@endsection
