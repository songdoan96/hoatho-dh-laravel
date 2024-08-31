@extends('layouts.app')
@section('content')
    <div class="min-h-screen flex flex-col">
        <div id="header" class="flex items-center px-2 py-1 bg-blue-500 text-white">
            <a href="{{ route('produce.dashboard') }}">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-10">
            </a>
            <h1 class="text-center text-2xl uppercase font-bold w-full">Đơn hàng chờ sản xuất</h1>
        </div>
        <div class="form p-4 shadow-lg">
            <form method="POST" action="{{ route('plan.store') }}" class="flex gap-4">
                @csrf
                <select id="chuyen" name="chuyen" required
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option value="">Chọn chuyền</option>
                    @foreach ($factories as $factory)
                        <option value="{{ $factory->line }}">{{ $factory->line }}</option>
                    @endforeach
                </select>
                <input type="text" id="khachhang" name="khachhang" placeholder="Khách hàng"
                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                       required/>
                <input type="text" id="mahang" name="mahang" placeholder="Mã hàng"
                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                       required/>
                <input type="date" id="ngaydukien" name="ngaydukien" title="Ngày dự kiến rải chuyền"
                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                       min="{{ date('Y-m-d') }}" required/>
                <input type="number" id="sltacnghiep" name="sltacnghiep" min="1" placeholder="SL tác nghiệp"
                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                       required/>
                <input type="number" id="mucvon" name="mucvon" min="0" step="any" placeholder="Mức vốn"
                       required
                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"/>
                <input type="text" id="ghichu" name="ghichu" placeholder="Ghi chú"
                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"/>
                <button type="submit"
                        class="text-white bg-white-700 bg-blue-500 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center flex">
                    Thêm
                </button>
            </form>
        </div>

        @if (count($plans))
            <div class="relative overflow-x-auto p-4">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 border">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-300 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Chuyền
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Khách hàng
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Mã hàng
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Ngày dự kiến rải chuyền
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Tác nghiệp
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Mức vốn
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Ghi chú
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Đã rải chuyền
                        </th>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($plans as $plan)
                        <tr
                            class="{{ $plan->daraichuyen ? 'bg-green-100' : 'bg-gray-50' }} border-b dark:bg-gray-800 dark:border-gray-700 group">
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                <div class="flex items-center gap-2">

                                    {{ $plan->chuyen }}
                                    @if (!$plan->daraichuyen)
                                        <form action="{{route('plan.planDelete',$plan)}}" method="post">
                                            @csrf
                                            @method("DELETE")
                                            <button onclick="return confirm('Xóa kế hoạch đơn hàng này?')"
                                                    class="text-red-700 text-xl">&times;
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </th>
                            <td class="px-6 py-4">
                                {{ $plan->khachhang }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $plan->mahang }}
                            </td>
                            <td class="px-6 py-4">
                                {{ formatDate($plan->ngaydukien,"d-m-Y") }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $plan->sltacnghiep }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $plan->mucvon }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $plan->ghichu }}
                            </td>
                            <td class="px-6 py-4">
                                @if ($plan->daraichuyen)
                                    <div class="flex items-center justify-between">
                                        <i class="fa-regular fa-square-check fa-xl" style="color: green;"></i>
                                        <form class="hidden group-hover:block" action="{{ route('plan.planDone', $plan) }}" method="POST">
                                            @csrf
                                            <button type="submit" title="Kết thúc đơn hàng này?"
                                                    onclick="return confirm('Kết thúc đơn hàng này?')">
                                                <img src="{{asset('images/good.png')}}" alt="" width="30">
                                            </button>
                                        </form>
                                    </div>
                                @else
                                    <form action="{{ route('plan.planUp', $plan) }}" method="POST">
                                        @csrf
                                        <button type="submit" title="Rải chuyền"
                                                onclick="return confirm('Rải chuyền cho đơn hàng này')">
                                            <i class="fa-regular fa-square fa-xl"></i>
                                        </button>
                                    </form>
                                @endif
                            </td>

                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
        @endif


    </div>
@endsection
