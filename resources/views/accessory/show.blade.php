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

                    <div class="grid grid-cols-4 grid-rows-4 h-full gap-5">
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
                                                    <th class="border w-1/3">Mã hàng</th>
                                                    <th class="border w-2/3">Loại</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($containers[$day] as $index => $item)
                                                    @if ($index < 4)
                                                        <tr class="text-left">
                                                            <td class="border"><span
                                                                    class="line-clamp-1">#{{ $item[1] }}</span></td>
                                                            <td class="border"><span
                                                                    class="line-clamp-1">{{ $item[2] }}</span></td>
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
                <div class="w-1/3 flex flex-col p-4 gap-4">
                    <div class="flex h-2/3 bg-white justify-center relative">
                        <div class="absolute left-1 top-1">
                            <a href="{{ route('accessory.dashboard') }}">
                                <img class="w-16" src="{{ asset('images/logo.png') }}" alt="">
                            </a>
                        </div>
                        <canvas id="myChart"></canvas>
                    </div>
                    <div class="flex h-1/3 gap-4">
                        <div class="w-1/2 bg-white">
                            <h6 class="text-center uppercase font-bold">Danh mục phụ liệu đặc biệt</h6>
                            <div class="flex p-2">
                                <li class="list-disc font-semibold">Motives : <span class="font-medium">Silicon</span></li>
                            </div>
                        </div>
                        <div class="w-1/2 bg-white">
                            <h6 class="text-center uppercase font-bold">Phụ liệu tồn</h6>
                            <div class="flex flex-col p-2">
                                <li class="list-disc font-semibold">Tồn 3 tháng : <span class="font-medium">Tongfan</span>
                                </li>
                                <li class="list-disc font-semibold">Tồn 6 tháng : <span class="font-medium">Motives</span>
                                </li>
                                <li class="list-disc font-semibold">Tồn 8 tháng : <span class="font-medium">DXL</span></li>
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
