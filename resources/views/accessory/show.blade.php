@extends('layouts.app')
@section('title', 'QUẢN LÝ XUẤT NHẬP TỒN PHỤ LIỆU')
@push('styles')
    <style>
        table th {
            min-width: 50px;
        }
    </style>
@endpush
@section('content')

    <div class="h-screen flex flex-col bg-gray-200">
        <div id="header" class="hidden tems-center px-2 py-1 bg-blue-500 text-white">
            <a href="{{ route('accessory.dashboard') }}">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-10">
            </a>
            <h1 class="text-center text-2xl uppercase font-bold w-full">KHO PHỤ LIỆU</h1>

        </div>
        @if (count($accessories))
            <div class="flex flex-1">
                <div class="w-2/3 h-screen flex flex-col p-4">
                    {{-- <div class="h-12 flex items-center justify-center">
                        <h6 class="font-bold text-2xl uppercase">Năng lực kho</h6>
                    </div> --}}

                    <div class="grid grid-cols-4 h-full w-full gap-5">
                        @php
                            $countDay = [];
                            $countEmpty = 0;
                        @endphp
                        @foreach (range('A', 'L') as $day)
                            @php
                                $firstAccessory = $containers[$day]->first() ?? null;
                                $bg = $firstAccessory ? 'green' : 'gray';
                                $khachhang = $firstAccessory ? strtoupper($firstAccessory->khachhang) : null;
                                if ($khachhang != null) {
                                    if (isset($countDay[$khachhang]) && in_array($countDay[$khachhang], $countDay)) {
                                        $countDay[$khachhang] = $countDay[$khachhang] + 1;
                                    } else {
                                        $countDay[$khachhang] = 1;
                                    }
                                } else {
                                    $countEmpty += 1;
                                }

                            @endphp
                            <div class="rounded border relative shadow  bg-{{ $bg }}-100">
                                <a href="{{ route('accessory.row', $day) }}"
                                    class="absolute -right-4 -top-2 text-white bg-{{ $bg }}-500 rounded
                                    h-10 w-10 flex items-center justify-center font-bold text-xl">{{ $day }}</a>
                                <div class="bg-green-600 h-0"></div>
                                <div class="bg-gray-600 h-0"></div>
                                <div class="bg-{{ $bg }}-600">
                                    <p class="text-center font-bold text-white">
                                        {{ $khachhang }}
                                    </p>
                                </div>
                                @if ($khachhang)
                                    <div class="flex flex-col">
                                        @foreach ($containers[$day] as $container)
                                            <ul class="flex gap-1">
                                                <li class="w-1/2 line-clamp-1" title="{{ $container->mahang }}">
                                                    #{{ $container->mahang }}</li>
                                                <li class="w-1/2 line-clamp-1" title="{{ $container->loai }}">
                                                    :{{ $container->loai }}</li>
                                            </ul>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="w-1/3 flex flex-col p-4 gap-4">
                    <div class="flex flex-col h-2/3 bg-white justify-center relative p-4">
                        <div class="absolute left-1 top-1">
                            <a href="{{ route('accessory.dashboard') }}">
                                <img class="w-16" src="{{ asset('images/logo.png') }}" alt="">
                            </a>
                        </div>
                        <h6 class="h-1/6 flex justify-center items-center text-center py-2 font-bold text-xl uppercase">Năng
                            lực kho</h6>
                        <canvas class="flex-1" id="myChart"></canvas>
                        {{-- <h6 class="text-center font-bold text-base py-2">Trống {{ $countEmpty }}/13 dãy</h6> --}}
                        {{-- <h6 class="text-center font-bold text-base py-2">Trống {{ $countEmpty }}/12 dãy</h6> --}}
                    </div>
                    <div class="flex h-1/3 gap-4">
                        <div class="w-1/2 bg-white">
                            <h6 class="text-center uppercase font-bold">Danh mục phụ liệu đặc biệt</h6>
                            <div class="flex p-2">
                                <li class="list-disc font-semibold">Motives : <span class="font-medium">Silicon</span></li>
                            </div>
                        </div>
                        <div class="w-1/2 bg-white">
                            <h6 class="text-center uppercase font-bold">Phụ liệu chờ kiểm</h6>
                            <div class="flex flex-col px-2">
                                @foreach ($accWaiting as $acc)
                                    <li class="list-disc font-semibold text-sm line-clamp-1" title="{{ $acc->loai }}">
                                        #{{ $acc->mahang }}:{{ $acc->loai }}</li>
                                @endforeach

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif


    </div>
@endsection
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        function getRandomColor() {
            var letters = '0123456789ABCDEF';
            var color = '#';
            for (var i = 0; i < 6; i++) {
                color += letters[Math.floor(Math.random() * 16)];
            }
            return color;
        }
        const countDay = {!! json_encode($countDay) !!};
        let labels = ["Trống: " + {{ $countEmpty }}];
        let dataValue = [{{ $countEmpty }}];
        let backgroundColor = ["#ccc"];
        const colors = [
            "#FF0000",
            "#0000FF",
            "#00FF00",
            "#FFFF00",
            "#FFA500",
            "#800080",
            "#FFC0CB",
            "#8B4513",
            "#E3C000"
        ];
        Object.entries(countDay).forEach((day, index) => {
            labels.push(`${day[0]}: ${day[1]}`);
            dataValue.push(day[1]);
            if (colors[index]) {

                backgroundColor.push(colors[index]);
            } else {
                backgroundColor.push(getRandomColor());
            }
        });
        // labels.push("Trống: " + {{ $countEmpty }});
        // dataValue.push({{ $countEmpty }});
        // backgroundColor.push("#ccc")
        const data = {
            labels,
            datasets: [{
                label: 'Số dãy',
                data: dataValue,
                backgroundColor,
                hoverOffset: 4
            }]
        };
        const config = {
            type: 'doughnut',
            data: data,
        };
        const ctx = document.getElementById('myChart');
        new Chart(ctx, config);
    </script>
@endpush
