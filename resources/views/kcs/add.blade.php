@extends('layouts.app')
@push('meta')
    <meta name="viewport" content="width=device-width, initial-scale=1">
@endpush
@section('content')
    <div class="min-h-screen flex flex-col flex-wrap">
        <div id="header" class="flex items-center px-2 py-1 bg-blue-500 text-white">
            <a href="{{ route('kcs.dashboard') }}" class="w-10">
                <img src="{{ asset('images/logo.png') }}" alt="Logo">
            </a>
            <div class="flex flex-1 justify-between items-center">
                <h1 class="text-2xl uppercase font-bold text-center w-full">KCS {{ $xn }} - thêm chỉ tiêu ngày
                    <span class="font-bold text-black bg-white px-1">{{ date('d-m-Y') }}</span>
                </h1>
            </div>
        </div>
        <div class="w-full lg:w-2/3 mx-auto my-2 text-sm text-black bg-orange-200 py-2 px-6">
            <ul>
                <li class="list-disc">KCS thêm chỉ tiêu tại đây !</li>
                <li class="list-disc">Mỗi ngày chỉ được thêm 1 lần</li>
                <li class="list-disc">Kiểm tra thông tin chuyền trước khi thêm</li>
                <li class="list-disc font-bold text-red-500">Thêm chỉ tiêu trước 08h00 sáng hàng ngày</li>
                <li class="list-disc font-bold text-red-500">3 lỗi cao nhất phân cách bằng dấu phẩy <strong
                        class="font-black">,</strong></li>
            </ul>
        </div>
        <div class="flex justify-center flex-col items-center">
            <form method="post" action="{{ route('kcs.store') }}" class="w-full lg:w-2/3 border shadow-lg p-4">
                @csrf
                <div class="mb-2 text-base text-white bg-blue-500 p-4">
                    <h1 class="text-center font-bold uppercase mb-2">Thông tin đơn hàng</h1>
                    <ul>
                        <li>Chuyền: <span class="font-bold" id="chuyen"></span></li>
                        <li>Khách hàng: <span class="font-bold" id="khachhang"></span></li>
                        <li>Mã hàng: <span class="font-bold" id="mahang"></span></li>
                        <li>Tác nghiệp : <span class="font-bold" id="sltacnghiep"> </span></li>
                        {{--                        <li>Ngày rải chuyền :  <span class="font-bold" id="ngayrai"> </span></li> --}}
                    </ul>
                </div>
                <div class="mb-2">
                    <label for="plan_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Chọn
                        chuyền</label>
                    <select id="plan_id" name="plan_id" required
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="">--Chọn chuyền--</option>
                        @foreach ($plans as $plan)
                            <option value="{{ $plan->id }}">{{ $plan->chuyen }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-2">
                    <label for="chitieungay" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Chỉ
                        tiêu ngày</label>
                    <input type="number" id="chitieungay" name="chitieungay"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        required min="0" />
                </div>
                <div class="flex gap-4">
                    <a href="{{ route('kcs.dashboard') }}"
                        class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Hủy</a>
                    <button type="submit"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">
                        Thêm chỉ tiêu
                    </button>
                </div>
            </form>

        </div>
    </div>
@endsection
@push('scripts')
    <script>
        const planId = document.getElementById("plan_id");
        const plans = {!! json_encode($plans->toArray()) !!};
        planId.addEventListener('change', function() {
            const plan = plans.find(plan => plan.id == this.value)
            const chuyen = plan?.chuyen || "";
            const kh = plan?.khachhang || "";
            const mh = plan?.mahang || "";
            const sltacnghiep = plan?.sltacnghiep || "";
            // const ngayrai = plan?.ngayrai || "";
            document.getElementById("chuyen").textContent = chuyen;
            document.getElementById("khachhang").textContent = kh;
            document.getElementById("mahang").textContent = mh;
            document.getElementById("sltacnghiep").textContent = sltacnghiep;
            // document.getElementById("ngayrai").textContent = ngayrai;
        });
    </script>
@endpush
