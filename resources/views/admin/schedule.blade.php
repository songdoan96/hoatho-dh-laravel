@extends('layouts.admin')
@section('content')
    <div class="p-2 flex flex-col">
        <h1 class="text-center w-full text-3xl uppercase font-bold my-4">Lịch làm việc</h1>
        <form class="flex gap-4 w-full justify-center" id="formAddSchedule" method="POST"
            action="{{ route('admin.scheduleStore') }}">
            @csrf
            <input type="date" name="date"
                class="border text-sm rounded-lg block p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500">
            <input type="text" name="content"
                class="border text-sm rounded-lg block p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500">
            <button type="submit"
                class="text-white
                        bg-blue-700 hover:bg-blue-800 focus:ring-4 font-medium
                        rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">
                Thêm lịch
            </button>
        </form>
        <div class="flex flex-wrap mt-4">
            <table class="w-full">
                <thead>
                    <tr>
                        <td class="border font-bold">STT</td>
                        <td class="border w-3/4 p-2 font-bold">Nội dung</td>
                        <td class="border w-1/4 p-2 font-bold"></td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($schedules as $index => $schedule)
                        <tr>
                            <td class="border p-2">{{ $index + 1 }}</td>
                            <td class="border p-2">{{ $schedule->content }}</td>
                            <td class="flex gap-8 border p-2">
                                <form method="post" action="{{ route('admin.scheduleDone', $schedule) }}"
                                    id="schedule-done-{{ $schedule->id }}">
                                    @csrf
                                    <input onchange="document.getElementById('schedule-done-{{ $schedule->id }}').submit()"
                                        type="checkbox" {{ $schedule->done ? 'checked' : null }}>
                                </form>
                                <form id="schedule-delete-{{ $schedule->id }}"
                                    action="{{ route('admin.scheduleDelete', $schedule) }}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <button
                                        onclick="if(confirm('Xóa lịch')) document.getElementById('schedule-delete-{{ $schedule->id }}').submit()"
                                        type="submit"><i class="fa-regular fa-trash-can"></i></button>
                                </form>
                            </td>
                        </tr>
                </tbody>
                @endforeach
            </table>
        </div>
    </div>
@endsection
