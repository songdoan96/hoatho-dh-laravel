@extends('layouts.app')

@section('content')
    <div class="flex justify-center items-center h-screen">
        <form class="w-full md:w-3/5 mx-auto bg-gray-200 rounded" action="{{ route('cutting.btpEditPlanUpdate', $btp) }}"
            method="post">
            @csrf
            <p class="text-center uppercase py-2 font-bold text-2xl">Chuyền {{ $btp->plan->chuyen }}</p>

            <div class="px-4 md:px-5 space-y-4">
                <div class="grid gap-6 mb-6 md:grid-cols-1">
                    <div>
                        <label for="size"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Size</label>
                        <input type="text" id="size" name="size" value="{{ $btp->size }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                    </div>
                    <div>
                        <label for="color"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Màu</label>
                        <input type="text" id="color" name="color" value="{{ $btp->color }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                    </div>
                    <div>
                        <label for="slkh"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">SLKH</label>
                        <input type="number" id="slkh" name="slkh" value="{{ $btp->slkh }}" required
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                    </div>
                    <div class="flex gap-4">
                        <a href="{{ route('cutting.editBtp', $btp->plan->id) }}"
                            class="min-w-20 flex items-center justify-center py-2.5 px-5 text-sm font-medium text-white focus:outline-none bg-red-700 hover:bg-red-800 rounded-lg border border-gray-200 focus:z-10 focus:ring-4 focus:ring-gray-100 ">Hủy</a>

                        <button type="submit"
                            class="min-w-20 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Sửa</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
