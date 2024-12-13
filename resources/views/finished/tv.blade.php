@extends('layouts.finished')
@push('meta')
    <meta http-equiv="refresh" content="1800">
@endpush
@section('content')
    <div class="main flex flex-1 w-screen">
        <div class="flex w-full gap-1">
            <div class="w-5/6 flex flex-col gap-4">
                <div class="flex h-1/2">
                    <div
                        class="flex flex-col text-3xl w-8 gap-0 justify-center items-center font-bold border-2 border-black">
                        <span>T</span>
                        <span>Ầ</span>
                        <span>N</span>
                        <span>G</span>
                        <span>1</span>
                    </div>
                    <div class="grid grid-cols-4 flex-1 grid-rows-2">
                        @foreach (range('A', 'H') as $container)
                            <div class="flex border-x border-black border-b">
                                <div class="grid grid-cols-4 flex-1">
                                    @for ($i = 1; $i <= 4; $i++)
                                        @php
                                            $finishes = \App\Models\Finished::where('daxuat', 0)
                                                ->where('vitri', $container . $i)
                                                ->get();
                                        @endphp
                                        @if (count($finishes))
                                            <div
                                                class="flex flex-col border gap-1 overflow-x-hidden bg-green-200 border-black">
                                                <p class="text-center font-bold border-b border-black leading-none">
                                                    {{ $container . $i }}
                                                </p>
                                                <p class="text-xs text-center leading-none line-clamp-1">
                                                    {{ $finishes[0]->khachhang }}
                                                </p>
                                                <p
                                                    class="text-xs text-center border-b border-black leading-none line-clamp-1">
                                                    #{{ $finishes[0]->mahang }}</p>
                                                <ul style="font-size: 10px">
                                                    @foreach ($finishes as $finish)
                                                        <li>{{ $finish->po }}: {{ $finish->sothung }}T</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @else
                                            <div
                                                class="flex flex-col border gap-1 overflow-x-hidden bg-gray-100 border-black">
                                                <p class="text-center font-bold border-b border-black leading-none">
                                                    {{ $container . $i }}
                                                </p>
                                                <p class="text-xs text-center leading-none font-bold">--</p>
                                                <p class="text-xs text-center border-b border-black leading-none font-bold">
                                                    --</p>
                                            </div>
                                        @endif
                                    @endfor
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="flex h-1/2">
                    <div
                        class="flex flex-col text-3xl w-8 gap-0 justify-center items-center font-bold border-2 border-black">
                        <span>T</span>
                        <span>Ầ</span>
                        <span>N</span>
                        <span>G</span>
                        <span>2</span>
                    </div>
                    <div class="grid grid-cols-4 flex-1">
                        @foreach (range('I', 'P') as $container)
                            <div class="flex border-x border-black border-b">
                                <div class="grid grid-cols-4 flex-1">
                                    @for ($i = 1; $i <= 4; $i++)
                                        @php
                                            $finishes = \App\Models\Finished::where('daxuat', 0)
                                                ->where('vitri', $container . $i)
                                                ->get();
                                        @endphp
                                        @if (count($finishes))
                                            <div
                                                class="flex flex-col border gap-1 overflow-x-hidden bg-green-200 border-black">
                                                <p class="text-center font-bold border-b border-black leading-none">
                                                    {{ $container . $i }}
                                                </p>
                                                <p class="text-xs text-center leading-none line-clamp-1">
                                                    {{ $finishes[0]->khachhang }}
                                                </p>
                                                <p
                                                    class="text-xs text-center border-b border-black leading-none line-clamp-1">
                                                    #{{ $finishes[0]->mahang }}</p>
                                                <ul style="font-size: 10px">
                                                    @foreach ($finishes as $finish)
                                                        <li>{{ $finish->po }}: {{ $finish->sothung }}T</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @else
                                            <div
                                                class="flex flex-col border gap-1 overflow-x-hidden bg-gray-100 border-black">
                                                <p class="text-center font-bold border-b border-black leading-none">
                                                    {{ $container . $i }}
                                                </p>
                                                <p class="text-xs text-center leading-none font-bold">--</p>
                                                <p class="text-xs text-center border-b border-black leading-none font-bold">
                                                    --</p>
                                            </div>
                                        @endif
                                    @endfor
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="w-1/6">
                <h6 class="font-bold text-center uppercase text-xl">Lịch final/xuất</h6>
                <table class="w-full text-xs text-left rtl:text-right text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-200">
                        <tr>
                            <th scope="col" class="p-1 border border-black">
                                PO
                            </th>
                            <th scope="col" class="p-1 border border-black">
                                NGÀY final
                            </th>
                            <th scope="col" class="p-1 border border-black">
                                NGÀY XUẤT
                            </th>
                            <th scope="col" class="p-1 border border-black">
                                SỐ THÙNG
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $finishesFinalXuat = \App\Models\Finished::where('daxuat', 0)
                                ->whereNotNull('ngay_xuat')
                                ->orWhereNotNull('ngay_final')
                                ->get();
                        @endphp
                        @foreach ($finishesFinalXuat as $item_xuat)
                            <tr class="bg-white border-b hover:bg-gray-50">
                                <td class="p-1 border border-black">
                                    {{ $item_xuat->po }}
                                </td>
                                <td class="p-1 border border-black">
                                    {{ formatDate($item_xuat->ngay_final, 'd/m') }}
                                </td>
                                <td class="p-1 border border-black">
                                    {{ formatDate($item_xuat->ngay_xuat, 'd/m') }}
                                </td>
                                <td class="p-1 border border-black">
                                    {{ $item_xuat->sothung }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
