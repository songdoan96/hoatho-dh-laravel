@extends('layouts.app')
@section('content')
    <div class="min-h-screen flex flex-col">
        <div id="header" class="flex items-center px-2 py-1 bg-blue-500 text-white">
            <a href="{{route('produce.dashboard')}}" class="w-10">
                <img src="{{asset('images/logo.png')}}" alt="Logo">
            </a>
            <div class="flex items-center gap-4 flex-1 justify-center">
                <h1 class="text-center text-2xl uppercase font-bold">ĐƠN HÀNG ĐÃ KẾT THÚC SẢN XUẤT</h1>
            </div>
        </div>
        <div class="p-4">
            <div class="relative overflow-x-auto mx-auto">
                <table class="w-full text-base text-center text-black border">
                    <thead class=" font-bold text-gray-700 uppercase bg-blue-300">
                    <tr>
                        <th class="border p-2">
                            Chuyền
                        </th>
                        <th class="border p-2">
                            Khách hàng
                        </th>
                        <th class="border p-2">
                            Mã hàng
                        </th>
                        <th class="border p-2">
                            Ngày kết thúc
                        </th>

                        <th class="border p-2">
                            LK tác nghiệp
                        </th>

                        <th class="border p-2">
                            LK nhập hoàn thành
                        </th>
                        <th class="border p-2">
                            SL thiếu
                        </th>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach($plans as $plan)
                        <tr class="text-lg">
                            <td class="border p-2 font-bold ">
                                {{$plan->chuyen}}
                            </td>
                            <td class="border p-2">
                                {{$plan->khachhang}}
                            </td>
                            <td class="border p-2">
                                {{$plan->mahang}}
                            </td>
                            <td class="border p-2">
                                {{formatDate($plan->ngayxong,"d-m-Y")}}
                            </td>
                            <td class="border p-2">
                                {{$plan->sltacnghiep}}
                            </td>
                            @php $slthieu=$plan->sltacnghiep-$plan->nhaphoanthanh; @endphp
                            <td class="border p-2 flex justify-center">
                                <a href="{{route('produce.editWarehouse',$plan)}}" class="mr-2 underline">
                                    <span>{{$plan->nhaphoanthanh}}</span>
                                </a>
                                <div class="w-6">
                                    @if($slthieu>0)
                                        <img src="{{asset('images/alert.gif')}}" alt="Nhập thiếu">
                                    @else
                                        <img src="{{asset('images/ok.png')}}" alt="Nhập đủ">
                                    @endif
                                </div>
                            </td>
                            <td class="border p-2 @php if ($slthieu>0) echo 'bg-red-300' @endphp">
                                {{$slthieu}}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
