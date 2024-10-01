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
        <div id="header" class="flex items-center px-2 py-1 bg-blue-500 text-white">
            <a href="{{ route('accessory.dashboard') }}">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-10">
            </a>
            <h1 class="text-center text-2xl uppercase font-bold w-full">KHO PHỤ LIỆU</h1>

        </div>
        @if (count($accessories))
            <div class="flex flex-1">
                <div class="w-1/2 h-full flex flex-col p-4">
                    {{-- <div class="h-12 flex items-center justify-center">
                        <h6 class="font-bold text-2xl uppercase">Năng lực kho</h6>
                    </div> --}}

                    <div class="grid grid-cols-3 grid-rows-4 h-full gap-5">
                        @foreach (array_merge(range('A', 'L'), ['TTH']) as $day)
                            <div
                                class="rounded border relative shadow  {{ in_array($day, array_keys($containers)) ? 'bg-green-100' : 'bg-gray-400' }}">
                                <a href="{{ route('accessory.row', $day) }}"
                                    class="absolute -right-4 -top-2 text-white {{ in_array($day, array_keys($containers)) ? 'bg-green-500' : 'bg-gray-500' }} rounded h-10 w-10 flex items-center justify-center font-bold text-xl">
                                    {{ $day }}
                                </a>
                                <div class="flex w-full">
                                    @if (in_array($day, array_keys($containers)))
                                        <table class="text-center w-full">
                                            <thead>
                                                <tr>
                                                    <th class="border">Mã hàng</th>
                                                    <th class="border">Loại</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($containers[$day] as $index => $item)
                                                    @if ($index < 4)
                                                        <tr class="text-left">
                                                            <td class="border">#{{ $item[1] }}</td>
                                                            <td class="border">{{ $item[2] }}</td>
                                                        </tr>
                                                    @endif
                                                @endforeach
                                            </tbody>
                                        </table>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="w-1/2 flex flex-col p-4">
                    <div class="flex h-2/3 bg-white justify-center">
                        <canvas id="myChart"></canvas>
                    </div>
                    <div class="flex h-1/3">
                        <div class="w-1/2">
                            <h6 class="text-center">Danh mục phụ liệu đặc biệt</h6>
                            <div class="flex">
                                <div class="w-1/2">
                                    <h6>#Motives</h6>
                                    <ul>
                                        <li>Keo</li>
                                        <li>Keo</li>
                                        <li>Keo</li>
                                    </ul>
                                </div>
                                <div class="w-1/2">
                                    <h6>#FAM</h6>
                                    <ul>
                                        <li>Keo</li>
                                        <li>Keo</li>
                                        <li>Keo</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="w-1/2">
                            <h6 class="text-center">Phụ liệu tồn</h6>
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


        var countCustomers = {!! json_encode($countCustomers) !!};
        let labels = [];
        let getData = [];
        let backgroundColor = [];
        let empty = 13;

        for (const [key, value] of Object.entries(countCustomers)) {
            getData.push(value);
            backgroundColor.push(getRandomColor());
            labels.push(`${key}:${value}`);
            empty -= value;
        }
        getData.push(empty)
        backgroundColor.push("#9CA3AF");
        labels.push(`Trống:${empty}`);

        const data = {
            labels,
            datasets: [{
                label: 'SL',
                data: getData,
                backgroundColor,
                hoverOffset: 4
            }],

        };
        const config1 = {
            type: 'doughnut',
            data,
            options: {
                plugins: {
                    title: {
                        display: true,
                        text: 'NĂNG LỰC KHO',
                        padding: {
                            bottom: 0,
                            top: 4
                        },
                        font: {
                            size: 30,
                        }
                    },
                    legend: {
                        display: true,
                        position: 'left',
                        labels: {
                            font: {
                                size: 20
                            }

                        }
                    },
                }
            },
        };
        const ctx1 = document.getElementById('myChart');
        new Chart(ctx1, config1)
    </script>
@endpush
