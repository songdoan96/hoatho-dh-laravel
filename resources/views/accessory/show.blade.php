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
                <div class="w-1/2">
                    <div class="w-72">
                        <canvas id="myChart"></canvas>
                    </div>
                </div>
            </div>
        @endif




    </div>
@endsection
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const data = {
            labels: [
                'Chứa PL={{ count($containers) }}',
                'Trống={{ 13 - count($containers) }}',
            ],
            datasets: [{
                label: 'SL',
                data: [{{ count($containers) }}, {{ 13 - count($containers) }}],
                backgroundColor: [
                    'rgb(220, 252, 231)',
                    'rgb(156, 163, 175)',
                ],
                hoverOffset: 4
            }]
        };
        const config = {
            type: 'pie',
            data: data,
        };
        const ctx = document.getElementById('myChart');
        new Chart(ctx, config)
    </script>
@endpush
