@extends('layouts.app')

@section('content')
    <form method="POST" action="{{ route('cutting.updateBtpWithDay', $btp) }}"
        class="uppercase mx-auto w-full md:w-3/5 text-black bg-gray-200 shadow-lg p-4 grid grid-cols-1 gap-2">
        @csrf
        <input type="hidden" name="btp_day_id" value="{{ $btpDay->id ?? null }}">
        <input type="hidden" name="btp_id" value="{{ $btp->id ?? null }}">
        <div class="mb-1">
            <label for="ngay" class="block mb-2 text-sm font-medium">Ngày</label>
            <input type="date" id="ngay" name="ngay" required max="{{ date('Y-m-d') }}"
                value="{{ date('Y-m-d') }}" class="border text-sm rounded-lg block w-full p-2.5 bg-white" />
        </div>
        <div class="mb-1">
            <label for="slcat" class="block mb-2 text-sm font-medium">SL cắt</label>
            <input type="text" id="slcat" name="slcat" value="{{ $btpDay->slcat ?? 0 }}" required
                class="border text-sm rounded-lg block w-full p-2.5 bg-white" />
        </div>
        <div class="mb-1">
            <label for="slcap" class="block mb-2 text-sm font-medium">SL cấp</label>
            <input type="text" id="slcap" name="slcap" value="{{ $btpDay->slcap ?? 0 }}" required
                class="border text-sm rounded-lg block w-full p-2.5 bg-white" />
        </div>


        <div class="flex justify-start items-end mb-1">
            <a href="{{ route('cutting.editBtp', $btp->plan_id) }}"
                class="min-w-24 block text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center mr-2">Hủy</a>
            <button type="submit" id="simple-add-btn"
                class="min-w-24 text-white bg-white-700 bg-blue-500 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center flex">
                Cập nhật
            </button>
        </div>
    </form>
@endsection
