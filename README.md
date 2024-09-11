control.php: lay ke hoach co thuc hien < kehoach

--Backup 2 database

--Redirect
---- http://localhost/hoathodh/sanxuatdh/index.php :
header("Location: http://localhost:8000/sanxuat") ;

--- http://localhost/hoathodh/kcs/dailyreport.php
--- http://localhost/hoathodh/kcs/control.php
header("Location: http://localhost:8000/kcs");

---- http://localhost/hoathodh/sanxuatdh/history.php
header("Location: http://localhost:8000/sanxuat/ket-thuc");

---- http://localhost/hoathodh/sanxuatdh/waiting.php
header("Location: http://localhost:8000/kehoach");

---- http://localhost/hoathodh/sanxuatdh/lineinfo.php?chuyen=01
header("Location: http://localhost:8000/kcs/XN1_02");

if (strlen($chuyen) == 2) {
header("Location: http://localhost:8000/kcs/XN1_$chuyen");
} else {
$chuyenX2 = explode(".", $chuyen);
$new = $chuyenX2[1];
header("Location: http://localhost:8000/kcs/XN2_$new");
}

<!-- *
@extends('layouts.app')
@push('meta')
    <meta http-equiv="refresh" content="15">
@endpush
@push('styles')
    <style>
        @font-face {
            font-family: '7-Segment';
            src: url('{{ asset('fonts/number.ttf') }}');
        }

        .number {
            font-family: '7-Segment';
            line-height: 1;
            white-space: nowrap;
        }
    </style>
@endpush
@section('content')
    <div class="bg-black text-white h-screen w-screen">
        @if ($plan)
            @php
                $chuyen = explode('_', $plan->chuyen);
            @endphp
            <div class="h-full w-full overflow-hidden bg-blue-800 text-white text-xl uppercase flex flex-col gap-1">
                <div class="h-[150px] flex border-b-2">
                    <div class="w-1/4 h-full left flex flex-col justify-between items-center p-2 border-r-2 border-l-2">
                        <div class="flex h-2/3 w-full justify-between items-center font-extrabold text-5xl">
                            <a href="{{ route('produce.dashboard') }}">
                                <img src="{{ asset('images/logo.png') }}" alt="" width="70px">
                            </a>
                            <p>{{ $plan->chuyen }}</p>
                        </div>
                        <div class="flex h-1/3 w-full justify-between items-center font-extrabold text-4xl">
                            @isset($kcs)
                                <a href="{{ route('kcs.editWorker', $kcs) }}">LĐ: {{ $kcs->laodong }}</a>
                                <a href="{{ route('kcs.editWorker', $kcs) }}">DP: {{ $kcs->duphong }}</a>
                            @else
                                <span>LĐ: --</span>
                                <span>DP: --</span>
                            @endisset

                        </div>
                    </div>
                    <div class="center flex-1 h-full p-2 flex font-extrabold">
                        <span class="text-center w-1/2">
                            <p class="text-3xl">ĐỊNH MỨC NGÀY</p>
                            <p class="text-9xl number">
                                @isset($kcs)
                                    <a href="{{ route('kcs.editWorker', $kcs) }}">{{ $kcs->chitieungay }}</a>
                                @else
                                    --
                                @endisset
                            </p>
                        </span>
                        <span class="text-center w-1/2">
                            <p class="text-3xl">ĐỊNH MỨC H.TẠI</p>
                            <p class="text-9xl number">{{ $dmhientai ?? 0 }}</p>
                        </span>
                    </div>
                    <div class="w-1/4 h-full left flex justify-between items-center p-2 border-l-2 border-r-2">
                        <div class="flex flex-col h-full justify-between font-extrabold text-4xl">
                            <p>{{ $plan->khachhang }}</p>
                            <p>{{ $plan->mahang }}</p>
                        </div>
                        <div class="image">
                            @if ($plan->logo)
                                <img src="{{ $plan->logo }}" alt="" width="70px">
                            @else
                                <div class="bg-gray-400 h-20 w-20"></div>
                            @endif

                        </div>
                    </div>
                </div>
                <div class="h-[calc(100vh-150px)] text-4xl leading-none font-extrabold grid grid-cols-4 gap-1">
                    <div class="border-2 text-center flex flex-col items-center gap-2 p-2">
                        <span>SỐ LƯỢNG ĐẠT</span>
                        <span class="text-9xl number">{{ $kcs->sldat ?? '--' }}</span>
                    </div>
                    <div class="border-2 text-center flex flex-col items-center gap-2 p-2">
                        <span>TỶ LỆ ĐẠT</span>
                        <span class="text-9xl number tracking-wider">
                            @isset($tyleloi)
                                {{ round($tyledat, 1) }}<span class="text-5xl">%</span>
                            @else
                                --
                            @endisset
                        </span>
                    </div>
                    <div class="border-2 text-center flex flex-col items-center gap-2 p-2">
                        <span>SỐ LƯỢNG LỖI</span>
                        <span class="text-9xl number">{{ $kcs->slloi ?? '--' }}</span>
                    </div>
                    <div class="border-2 text-center flex flex-col items-center gap-2 p-2">
                        <span>TỶ LỆ LỖI</span>
                        <span class="text-9xl number tracking-wider">
                            @isset($tyleloi)
                                {{ round($tyleloi, 1) }}<span class="text-5xl">%</span>
                            @else
                                --
                            @endisset
                        </span>
                    </div>
                    <div class="border-2 text-center flex flex-col items-center gap-2 p-2">
                        <span>TÁC NGHIỆP</span>
                        <a href="{{ route('produce.editWarehouseUpdate', $plan) }}" class="text-9xl number">
                            {{ $plan->sltacnghiep }}
                        </a>
                    </div>
                    <div class="border-2 text-center flex flex-col items-center gap-2 p-2">
                        <span>ĐÃ THỰC HIỆN</span>
                        <a href="{{ route('produce.editWarehouseUpdate', $plan) }}" class="text-9xl number">
                            {{ $plan->thuchien }}
                        </a>
                    </div>
                    <div class="border-2 text-center flex flex-col items-center gap-2 p-2">
                        <span>BTP CẤP</span>
                        <span class="text-9xl number">{{ $plan->btpcap }}</span>
                    </div>
                    <div class="border-2 text-center flex flex-col items-center gap-2 p-2">
                        <span>VỐN</span>
                        <span class="text-9xl number tracking-wider">{{ isset($von) ? round($von, 1) : '--' }}</span>
                    </div>
                    <div class="border-2 text-center flex flex-col items-center gap-2 p-2">
                        <span>NHẬP KHO</span>
                        <a href="{{ route('produce.editWarehouseUpdate', $plan) }}" class="text-9xl number">
                            {{ $plan->nhaphoanthanh }}
                        </a>
                    </div>
                    <div class="border-2 text-center flex flex-col items-center gap-2 p-2">
                        <span>NHẬP THIẾU</span>
                        <a href="{{ route('produce.editWarehouseUpdate', $plan) }}" class="text-9xl number">
                            {{ $plan->thuchien - $plan->nhaphoanthanh }}
                        </a>
                    </div>
                    <div class="border-2 text-center flex flex-col items-center gap-2 p-2 col-span-2">
                        <span>3 lỗi cao nhất</span>
                        @if (count($errors) > 0 && $errors[0] != '')
                            <span class="text-xl text-left w-full px-4">
                                @foreach ($errors as $index => $error)
                                    <p>{{ $index + 1 }}. {{ $error }}</p>
                                @endforeach
                            </span>
                        @endif
                    </div>
                </div>
            </div>
        @else
            <div class="w-full h-full flex justify-center items-center">
                <h4 class="uppercase text-7xl font-bold">Chưa có thông tin sản xuất</h4>
            </div>
        @endif
    </div>
@endsection

* -->

<!-- DB 11-09-2024 -->

INSERT INTO `simples` (`id`, `khachhang`, `mahang`, `loaimau`, `color`, `size`, `soluong`, `npl`, `rap`, `tailieu`, `maugoc`, `ktmay`, `kcs`, `ngaymay`, `ngayhen`, `ngaygui`, `tinhtrang`, `ketqua`, `tuan`, `bienban`, `ngaycmt`, `ngayguilai`, `thaydoi`, `tralaiinfo`, `ghichu`, `created_at`, `updated_at`) VALUES
(1, 'Tongfan', 'ILFX-1340', 'PP', 'Grey', '30,32,40,42', 4, '2024-07-20', '2024-06-19', '2024-06-07', '2024-06-19', 'May mẫu + kaizen 2 XN', 'Hiền', '2024-07-31', '2024-08-02', '2024-08-02', 'dagui', 'passed', 'T1-8-24', 1, '2024-07-29', NULL, NULL, NULL, 'Kaizen: ( Tuyển, Phan Phương, Huệ XN2, Vân,Phương, Anh)', '2024-08-19 11:02:55', '2024-08-25 07:25:57'),
(2, 'Tongfan', 'ILFX-1340', 'PP', 'Khakhi', '34', 1, '2024-07-20', '2024-06-19', '2024-06-07', '2024-06-19', 'May mẫu', 'Hiền', '2024-08-05', '2024-08-06', '2024-08-06', 'dagui', 'passed', 'T1-8-24', 1, '2024-08-10', NULL, NULL, NULL, 'Chi, Ngân, Hiền, Ngọc, Thích', '2024-08-19 11:06:35', '2024-08-25 07:26:14'),
(3, 'Motives', '8666', 'PP', 'Dark Navy', '36', 2, '2024-08-06', '2024-08-08', '2024-08-06', NULL, 'May mẫu', 'Hiền', '2024-08-09', '2024-08-15', '2024-08-14', 'dagui', 'passed', 'T2-8-24', 1, '2024-08-28', NULL, NULL, NULL, 'Chi, Ngân, Hiền', '2024-08-19 11:21:53', '2024-08-28 11:50:14'),
(4, 'Image wear', '1G109-618-7-006', 'Mẫu đối', 'Camo', '752-54', 2, '2024-08-10', '2024-08-10', '2024-06-24', '2024-06-24', 'May mẫu', 'Hiền', '2024-08-12', '2024-08-15', '2024-08-15', 'dagui', 'passed', 'T2-8-24', 1, '2024-08-29', NULL, NULL, NULL, 'Thích + Ngọc', '2024-08-19 11:26:13', '2024-08-28 11:49:07'),
(5, 'Image wear', '1L349-618-7-006', 'Mẫu đối', 'Camo', '752-54', 2, '2024-08-10', '2024-08-10', '2024-06-24', '2024-06-24', 'May mẫu', 'Hiền', '2024-08-12', '2024-08-15', '2024-08-15', 'dagui', 'passed', 'T2-8-24', 1, '2024-08-29', NULL, NULL, NULL, 'Thích + Ngọc', '2024-08-19 11:29:07', '2024-08-28 11:48:44'),
(6, 'Motives', '8363', 'PP', 'Dark Navy', 'M/35', 3, '2024-08-12', '2024-08-03', '2024-07-08', '2024-07-22', 'May mẫu', 'Hiền', '2024-08-15', '2024-08-24', '2024-08-23', 'dagui', 'pending', 'T3-8-24', 1, NULL, NULL, NULL, NULL, 'Chi + Hiền', '2024-08-19 11:36:31', NULL),
(7, 'Motives', '8363', 'Size set', 'Dark Navy', 'XS, 5XL /35', 4, '2024-08-12', '2024-08-03', '2024-07-08', '2024-07-15', 'May mẫu', 'Hiền', '2024-08-15', '2024-08-24', '2024-08-23', 'dagui', 'pending', 'T3-8-24', 1, NULL, NULL, NULL, NULL, 'Chi + Hiền', '2024-08-19 11:40:57', NULL),
(8, 'Tongfan', 'ILFX-1340', 'Size sets Ecom', 'Navy /Tan', '30,40/32', 3, '2024-07-20', '2024-06-19', '2024-06-07', '2024-06-19', 'XN 2', 'Viên', '2024-08-17', '2024-08-24', '2024-08-24', 'dagui', 'pending', 'T3-8-24', 1, NULL, NULL, NULL, NULL, 'Ngọc + Thích diều mẫu', '2024-08-20 04:29:52', '2024-08-28 11:47:44'),
(9, 'Tongfan ', 'ILFX-1340', 'Size sets Ecom', 'Gray', '34,36,38', 3, '2024-07-20', '2024-06-19', '2024-06-07', '2024-06-19', 'XN 1', 'Hiền', '2024-08-17', '2024-08-24', '2024-08-24', 'dagui', 'pending', 'T3-8-24', 1, NULL, NULL, NULL, NULL, 'Ngân diều mẫu', '2024-08-20 04:32:36', NULL),
(10, 'Tongfan', 'ILFX-1340', 'PP keep', 'Navy/Tan', '30,40,42/32', 7, '2024-07-20', '2024-06-19', '2024-06-07', '2024-06-19', 'XN 2', 'Viên', '2024-08-17', '2024-08-28', '2024-08-29', 'dagui', 'pending', 'T3-8-24', 1, NULL, NULL, NULL, NULL, 'Ngọc +Thích diều mẫu ( 18 pcs lấy 10pcs) Riêng size 42 size sets ecom. Mẫu bị lỗ kim xử lý lâu không kịp gửi 28.8', '2024-08-20 04:35:21', '2024-08-28 11:51:08'),
(11, 'Tongfan', 'ILFX-1340', 'PP keep', 'Gray', '34,36,38', 6, '2024-07-20', '2024-06-19', '2024-06-07', '2024-06-19', 'XN 1', 'Hiền', '2024-08-17', '2024-08-28', '2024-08-29', 'dagui', 'pending', 'T3-8-24', 1, NULL, NULL, NULL, NULL, 'Ngân diều mẫu ( 15pcs lấy 9pcs)', '2024-08-20 04:37:58', '2024-08-28 11:49:43'),
(12, 'Motives', '8363W', 'PP', 'Dark Navy', 'M', 3, '2024-08-20', '2024-07-26', '2024-07-22', '2024-07-22', 'May mẫu', 'Hiền', '2024-08-22', '2024-09-06', '2024-09-06', 'dagui', 'pending', 'T3-8-24', 1, NULL, NULL, NULL, NULL, 'Chi + Hiền', '2024-08-20 09:13:12', '2024-09-09 05:54:58'),
(13, 'Motives', '8363W', 'Size set', 'Dark Navy', 'XS,3XL', 4, '2024-08-20', '2024-07-26', '2024-07-22', '2024-07-22', 'May mẫu', 'Hiền', '2024-08-22', '2024-09-06', '2024-09-06', 'dagui', 'pending', 'T4-8-24', 1, NULL, NULL, NULL, NULL, 'Chi + Hiền', '2024-08-20 09:15:23', '2024-09-09 05:55:12'),
(18, 'Tongfan', 'ILFX-1340', 'PP keep', 'Khakhi', '42', 2, '2024-07-20', '2024-06-19', '2024-06-07', '2024-06-19', 'May mẫu + Kaizen x 2', 'Hiền', '2024-09-05', '2024-09-06', '2024-09-06', 'dagui', 'pending', 'T4-8-24', 1, NULL, NULL, NULL, NULL, 'Ngân, Ngọc, Lập ( diều 4pcs lấy 2pcs)', '2024-09-07 09:45:15', '2024-09-09 05:55:22'),
(19, 'Motives', '8717', 'PP', '05 French Blue', 'M-30REG', 3, '2024-09-05', '2024-08-26', '2024-07-29', '2024-08-27', 'May mẫu', NULL, '2024-09-07', '2024-09-12', NULL, 'dangmay', 'pending', NULL, 0, NULL, NULL, NULL, NULL, 'Ngọc + Hiền+ Ngân', '2024-09-07 09:45:59', '2024-09-07 09:45:59'),
(20, 'Motives', '8717', 'size set', '05 French Blue', 'XS, 6XL-30REG', 4, '2024-09-05', '2024-08-26', '2024-07-29', '2024-08-27', 'May mẫu', NULL, '2024-09-07', '2024-09-12', NULL, 'dangmay', 'pending', 'T1-9-24', 0, NULL, NULL, NULL, NULL, 'Ngọc + Hiền+ Ngân', '2024-09-07 09:46:10', '2024-09-07 09:46:10'),
(21, 'Motives', '8717W', 'size set', '05 French Blue', 'XS, 4XL-30REG', 4, '2024-09-05', '2024-08-29', '2024-08-26', '2024-08-27', 'May mẫu', NULL, '2024-09-07', '2024-09-12', NULL, 'dangmay', 'pending', 'T1-9-24', 0, NULL, NULL, NULL, NULL, 'Chi + Thích', '2024-09-07 09:46:16', '2024-09-07 09:46:16'),
(22, 'Motives', '8717W', 'PP', '05 French Blue', 'M-30REG', 3, '2024-09-05', '2024-08-29', '2024-07-29', '2024-08-27', 'May mẫu', NULL, '2024-09-07', '2024-09-12', NULL, 'dangmay', 'pending', 'T1-9-24', 0, NULL, NULL, NULL, NULL, 'Chi + Thích', '2024-09-07 09:46:20', '2024-09-07 09:46:20');

INSERT INTO `welcomes` (`id`, `path`, `active`) VALUES
(1, 'images/29OODsC40PLXQacN1az9xD32e1TpNDkXKuQjDJKx.jpg', 0),
(2, 'images/8nZnQGHkCzQDEEsQCgei41vbJ4Cr6ydx1BbMB0qY.jpg', 1),
(3, 'images/SuEqFLGnwxejfMhOgZTdXOL6QfPd9gZwO9W6QrMF.png', 1),
(4, 'images/lySVXuVau9Hx500pFaPR7HXXwScvWPamV3uByttS.jpg', 1),
(5, 'images/x267W1HNCW8TVl8Lx4uALzEnoKqcQKOQFZIe6hPB.jpg', 0);

INSERT INTO `plans` (`id`, `chuyen`, `khachhang`, `mahang`, `logo`, `ngaydukien`, `ngayrai`, `sltacnghiep`, `daraichuyen`, `thuchien`, `nhaphoanthanh`, `btpcap`, `mucvon`, `ghichu`, `daxong`, `ngayxong`, `created_at`) VALUES
(1, 'XN1_09', 'MOTIVES', '8671W', NULL, '2024-08-29', '2024-09-03', 956, 1, 910, 594, 0, 4.00, NULL, 1, '2024-08-31 05:56:06', '2024-09-03 05:50:51'),
(2, 'XN1_01', 'TONGFAN', '1340', 'images/logo/MNlxcJwWF2u4tUXBfqtF0a5MrDuVfSq1NA1SZ90Z.jpg', '2024-08-20', '2024-09-03', 53000, 1, 12396, 11894, 15214, 0.00, NULL, 0, NULL, '2024-09-03 05:57:51'),
(3, 'XN1_04', 'KWONGLUNG', '72175ABR', NULL, '2024-08-14', '2024-09-03', 18029, 1, 14795, 13030, 15598, 0.00, NULL, 0, NULL, '2024-09-03 06:07:10'),
(4, 'XN1_05', 'MOTIVES', '8666', 'images/logo/v2eOuecWeIwu3ajvOp2T8SSDP78BTiuXSdHzbBZ8.jpg', '2024-08-23', '2024-09-03', 16876, 1, 3450, 3252, 4731, 3.00, NULL, 0, NULL, '2024-09-03 06:13:08'),
(5, 'XN1_06', 'MOTIVES', '8665', 'images/logo/v2eOuecWeIwu3ajvOp2T8SSDP78BTiuXSdHzbBZ8.jpg', '2024-07-30', '2024-09-03', 8910, 1, 8910, 8658, 8900, 0.00, NULL, 1, '2024-09-10 02:40:25', '2024-09-03 06:16:15'),
(6, 'XN1_07', 'TONGFAN', '1340', 'images/logo/MNlxcJwWF2u4tUXBfqtF0a5MrDuVfSq1NA1SZ90Z.jpg', '2024-08-15', '2024-09-03', 23000, 1, 10536, 9896, 10850, 0.00, NULL, 0, NULL, '2024-09-03 06:18:55'),
(7, 'XN1_08', 'MOTIVES', '8676', 'images/logo/v2eOuecWeIwu3ajvOp2T8SSDP78BTiuXSdHzbBZ8.jpg', '2024-08-20', '2024-09-03', 6733, 1, 4729, 4291, 5839, 4.00, NULL, 0, NULL, '2024-09-03 06:22:22'),
(8, 'XN1_09', 'MOTIVES', '8671', 'images/logo/v2eOuecWeIwu3ajvOp2T8SSDP78BTiuXSdHzbBZ8.jpg', '2024-08-31', '2024-09-03', 6464, 1, 2548, 2378, 3874, 4.00, NULL, 0, NULL, '2024-09-03 06:25:10'),
(9, 'XN1_10', 'COSTCO', 'CT-8075', 'images/logo/QYI3cNk3vkDbFSSwBllTlpt3uEg5VIOqq34n6O06.png', '2024-04-08', '2024-09-03', 50296, 1, 42615, 42460, 43296, 0.00, NULL, 0, NULL, '2024-09-03 06:27:53'),
(10, 'XN2_02', 'COSTCO', '8075', 'images/logo/QYI3cNk3vkDbFSSwBllTlpt3uEg5VIOqq34n6O06.png', '2024-06-13', '2024-09-03', 50000, 1, 43119, 41791, 41173, 0.00, NULL, 0, NULL, '2024-09-03 06:31:40'),
(11, 'XN2_04', 'COSTCO', '8075', 'images/logo/QYI3cNk3vkDbFSSwBllTlpt3uEg5VIOqq34n6O06.png', '2024-05-18', '2024-09-03', 109098, 1, 107135, 106564, 106069, 0.00, NULL, 0, NULL, '2024-09-03 06:33:21'),
(12, 'XN2_05', 'TONGFAN', '1340', 'images/logo/MNlxcJwWF2u4tUXBfqtF0a5MrDuVfSq1NA1SZ90Z.jpg', '2024-08-15', '2024-09-03', 23000, 1, 7336, 6620, 7120, 0.00, NULL, 0, NULL, '2024-09-03 06:36:32'),
(13, 'XN2_06', 'TONGFAN', '1340', 'images/logo/MNlxcJwWF2u4tUXBfqtF0a5MrDuVfSq1NA1SZ90Z.jpg', '2024-08-15', '2024-09-03', 23000, 1, 6954, 6495, 6528, 0.00, NULL, 0, NULL, '2024-09-03 06:39:05'),
(14, 'XN2_07', 'TONGFAN', '1340', 'images/logo/MNlxcJwWF2u4tUXBfqtF0a5MrDuVfSq1NA1SZ90Z.jpg', '2024-08-22', '2024-09-03', 25000, 1, 4627, 3600, 4044, 2.50, NULL, 0, NULL, '2024-09-03 06:43:13'),
(15, 'XN2_08', 'TONGFAN', '1340', 'images/logo/MNlxcJwWF2u4tUXBfqtF0a5MrDuVfSq1NA1SZ90Z.jpg', '2024-08-22', '2024-09-03', 25000, 1, 5918, 5064, 4574, 2.50, NULL, 0, NULL, '2024-09-03 06:44:55'),
(16, 'XN2_09', 'TONGFAN', '1340', 'images/logo/MNlxcJwWF2u4tUXBfqtF0a5MrDuVfSq1NA1SZ90Z.jpg', '2024-08-20', '2024-09-03', 30000, 1, 6549, 6058, 6063, 2.50, NULL, 0, NULL, '2024-09-03 06:46:51'),
(17, 'XN1_06', 'MOTIVES', '8665W', 'images/logo/v2eOuecWeIwu3ajvOp2T8SSDP78BTiuXSdHzbBZ8.jpg', '2024-09-10', '2024-09-10', 1659, 1, 430, 145, 266, 4.00, NULL, 0, NULL, '2024-09-10 02:39:14');

INSERT INTO `kcs` (`id`, `plan_id`, `ngaytao`, `laodong`, `duphong`, `chitieungay`, `sldat`, `slloi`, `thuchien`, `nhaphoanthanh`, `btpcap`, `chitietloi`) VALUES
(1, 2, '2024-09-04', 0, 0, 960, 960, 79, 0, 0, 0, 'passan le chân+xiên+thiếu mũi+dật,lưng nhăn+dật+đùng+xì,chốt pasan kẹp'),
(2, 4, '2024-09-04', 0, 0, 300, 280, 22, 0, 0, 0, 'nút lệch,đầu lưng chúi,pa gết cong'),
(3, 5, '2024-09-04', 0, 0, 330, 341, 30, 0, 0, 0, 'bọ kẹp thiếu bọ.lưng leo mí hở mí.'),
(4, 6, '2024-09-04', 0, 0, 650, 630, 57, 0, 0, 0, 'lai xì+ cong+ không trùng chỉ.lưng xì+ bỏ mũi.diễu bao túi xéo bỏ mũi'),
(5, 7, '2024-09-04', 0, 0, 365, 365, 36, 0, 0, 0, 'mic tà xiên,bo tay không trùng chỉ'),
(6, 8, '2024-09-04', 0, 0, 360, 365, 35, 0, 0, 0, 'Mí cổ to nhỏ'),
(7, 9, '2024-09-04', 0, 0, 435, 435, 32, 0, 0, 0, 'trang trí TP ngược+thiếu,nách bỏ mũi,bo tay nhăn+không trùng chỉ'),
(8, 10, '2024-09-04', 65, 6, 720, 660, 70, 0, 0, 0, 'cổ sịp mí,lai sup mí,chèn tay sụp mí'),
(9, 11, '2024-09-04', 63, 4, 950, 960, 98, 0, 0, 0, 'Vs nách trong xì ,lai nhọn ,lè mí (dầu 60%)'),
(10, 12, '2024-09-04', 27, 1, 520, 420, 47, 0, 0, 0, 'lai lè.vặn .lưng nhăn.bọ bách xăng rối chỉ,không bằng lưng(bẩn 20%)'),
(11, 13, '2024-09-04', 26, 1, 500, 400, 45, 0, 0, 0, 'lưng lệch,xì.lai kẹp(bẩn 35%)'),
(12, 14, '2024-09-04', 30, 2, 420, 320, 42, 0, 0, 0, 'nhãn lưng lệch.lai cong xì.lung xì kẹp.bẩn 6%'),
(13, 15, '2024-09-04', 30, 0, 500, 420, 51, 0, 0, 0, 'lưng kẹp dây dệt.xì.lai cong,baget đứt chỉ,bẩn phấ 3%'),
(14, 16, '2024-09-04', 33, 1, 520, 500, 56, 0, 0, 0, 'lưng bỏ mủi. túi sau bỏ mủi.lai xì. hang bẩn phân 98%'),
(15, 3, '2024-09-04', 0, 0, 710, 665, 75, 0, 0, 0, 'sườn tay - bo tay đứt chỉ,quay cổ kẹp'),
(16, 6, '2024-09-05', 0, 0, 650, 600, 58, 0, 0, 0, 'lai bỏ mũi+ đứt chỉ,lưng dật+lưng xì,baget đôi lè'),
(17, 9, '2024-09-05', 0, 0, 435, 435, 35, 0, 0, 0, 'viền cổ sụp mí+to nhỏ,vắt sổ nách xì+kẹp lót,sườn bỏ mũi'),
(18, 5, '2024-09-05', 0, 0, 350, 345, 30, 0, 0, 0, 'lưng hở leo mí, vs btui xì, bọ hở ko đều thiếu bọ'),
(19, 7, '2024-09-05', 0, 0, 365, 365, 37, 0, 0, 0, 'bo tay lỗ kim+ktc,thiếu trang trí bách vai+lỗ kim'),
(20, 4, '2024-09-05', 0, 0, 300, 283, 23, 0, 0, 0, 'baget cong,đầu lưng chúi nút lệch'),
(21, 10, '2024-09-05', 67, 6, 720, 660, 72, 0, 0, 0, 'Cổ sụp mí to mí,lai sụp mí,gảy,thành phẩm sụp mí đít chi'),
(22, 2, '2024-09-05', 57, 2, 1050, 720, 55, 0, 0, 0, 'lưng nhăn+đùng+xì,pasan xiên+xì,Bọ pasan rối chỉ'),
(23, 3, '2024-09-05', 0, 0, 710, 665, 71, 0, 0, 0, 'sườn tay đứt chỉ,lai đứt chỉ,ngang tay đứt chỉ'),
(24, 14, '2024-09-05', 29, 2, 450, 360, 39, 0, 0, 0, 'Lai lè+xì+cong,lưng nhăn +kẹp,bẩn 6%'),
(25, 16, '2024-09-05', 31, 0, 550, 540, 53, 0, 0, 0, 'Lai đứt chỉ,\r\nMí Bao túi trong kẹp,\r\nVs sườn rút chỉ (hang bân 95%)'),
(26, 15, '2024-09-05', 30, 0, 500, 490, 47, 0, 0, 0, 'Lưng xì kẹp dây dệt bỏ mũi,Bọ px kẹp nhãn đùng,bẩn 4%'),
(27, 11, '2024-09-05', 61, 5, 970, 950, 91, 0, 0, 0, 'Cổ trong to nhỏ,mí túi ngực bỏ mủi,'),
(28, 12, '2024-09-05', 26, 1, 520, 440, 56, 0, 0, 0, 'lưng nhăn,gắn bách xăng lệch đối xứng vắt sổ đáy trước đứt chỉ.'),
(29, 13, '2024-09-05', 26, 1, 500, 411, 51, 0, 0, 0, 'lưng lệch nhãn,lưng xì,lai kẹp(bẩn 45%)'),
(30, 8, '2024-09-05', 0, 0, 365, 372, 34, 0, 0, 0, 'Khoá bách vai không trùng chỉ.'),
(31, 12, '2024-09-06', 0, 0, 550, 465, 52, 0, 0, 0, 'lai cong lè,lưng nhăn,bách xăng lệch đối xứng(bẩn25%)'),
(32, 11, '2024-09-06', 0, 0, 970, 950, 92, 0, 0, 0, 'Sừon bỏ mủi ,thân sau bỏ mủi'),
(33, 14, '2024-09-06', 0, 0, 480, 360, 40, 0, 0, 0, 'Lưng nhăn+xì,lai lè+xì,bẩn 6%'),
(34, 13, '2024-09-06', 0, 0, 530, 440, 48, 0, 0, 0, 'lưng lệch nhãn,lai kẹp,bách xăng lệch đối xứng(bẩn50%)'),
(35, 15, '2024-09-06', 0, 0, 530, 500, 49, 0, 0, 0, 'Lưng xì kẹp bỏ mũi.baghet đứt chỉ,bọ px kẹp xiên đứt chỉ,bẩn 10%'),
(36, 5, '2024-09-06', 0, 0, 350, 344, 32, 0, 0, 0, 'lưng hở mí leo mí.bọ túi xéo kẹp.nút lệch'),
(37, 6, '2024-09-06', 0, 0, 650, 550, 55, 0, 0, 0, 'lai vặn+bỏ mũi,lưng xì,bọ thành phẩm đứt chỉ'),
(38, 2, '2024-09-06', 0, 0, 1050, 700, 54, 0, 0, 0, 'Lưng nhăn+đùng+xì,bao túi sau đùng,Đáp túi sau đứt chỉ'),
(39, 4, '2024-09-06', 0, 0, 300, 270, 22, 0, 0, 0, 'lai đứt chỉ,đằu lưng chúi ,pa gết cong'),
(40, 7, '2024-09-06', 0, 0, 365, 365, 35, 0, 0, 0, 'mic tà xiên,bo tay ktc+lỗ kim'),
(41, 9, '2024-09-06', 0, 0, 435, 301, 22, 0, 0, 0, 'lá cổ vặn,áo số,diễu túi lót to nhỏ bờ'),
(42, 3, '2024-09-06', 0, 0, 710, 770, 80, 0, 0, 0, 'cổ sụp mí,sườn tay đứt chỉ - sụp mí,lai đứt chỉ'),
(43, 8, '2024-09-06', 0, 0, 365, 358, 32, 0, 0, 0, 'Trang trí bách vai kẹp.'),
(44, 10, '2024-09-06', 0, 0, 720, 660, 69, 0, 0, 0, 'Cổ sụp mí ,tay vặn ,lai sụp mí'),
(45, 16, '2024-09-06', 0, 0, 580, 560, 50, 0, 0, 0, 'Lưng xì bao túi,\r\nĐáp bao túi bỏ mũi, \r\nMi túi sau đứt chỉ ( hàng bẩn phấn95%)'),
(46, 10, '2024-09-07', 0, 0, 720, 670, 24, 0, 0, 0, 'Chèn tay bỏ mủi vs,cổ sụp mí,suon tay bỏ mủi vs,dầu 70%'),
(47, 12, '2024-09-07', 0, 0, 550, 465, 17, 0, 0, 0, 'bọ bách xăng rối chỉ,lai cong,sườn ngoài kẹp vắt sổ'),
(48, 13, '2024-09-07', 0, 0, 530, 440, 14, 0, 0, 0, 'lưng kẹp,lưng lệch nhãn,vắt sổ đáy trước đứt chỉ.(bẩn 35%)'),
(49, 8, '2024-09-07', 0, 0, 365, 365, 16, 0, 0, 0, 'Lai kẹp, lá cổ đứt chỉ'),
(50, 2, '2024-09-07', 0, 0, 1050, 960, 36, 0, 0, 0, 'lưng nhăn+xì+bỏ mũi+sụp mí,nhãn sai xiên,passan xiên+le chân'),
(51, 5, '2024-09-07', 0, 0, 350, 345, 11, 0, 0, 0, '!ưng hở leo mí cao thấp.nút lệch.bọ đáy rối chỉ kẹp'),
(52, 11, '2024-09-07', 0, 0, 970, 950, 32, 0, 0, 0, 'Thành phẩm bỏ mủi ,cổ bỏ mủi,thân trứoc lỏng chỉ'),
(53, 4, '2024-09-07', 0, 0, 300, 280, 10, 0, 0, 0, 'passan xiên bm,pa gết cong,bọ pa gết thấp'),
(54, 3, '2024-09-07', 0, 0, 710, 700, 26, 0, 0, 0, 'cổ - sườn tay sụp mí,lai đứt chỉ,bo tay sụp mí'),
(55, 16, '2024-09-07', 0, 0, 600, 570, 22, 0, 0, 0, 'Nhãn sai xì,\r\nLưng kẹp bao túi,\r\nLai đứt chỉ . (Hàng bẩn phấn 70%)'),
(56, 6, '2024-09-07', 0, 0, 650, 635, 23, 0, 0, 0, 'lai xì+lè,lưng xì bỏ mũi+lệch chữ,vắt sổ sườn rút chỉ+đứt chỉ'),
(57, 9, '2024-09-07', 0, 0, 435, 430, 15, 0, 0, 0, 'dây trang trí thành phẩm ngược,diễu nách nhăn +vặn+bỏ mũi,diễu cổ nhốt+vặn'),
(58, 7, '2024-09-07', 0, 0, 365, 365, 13, 0, 0, 0, 'cổ sụp mí,vai đùng'),
(59, 15, '2024-09-07', 0, 0, 550, 510, 20, 0, 0, 0, 'Lưng xì,lai xì,chốt px đứt chỉ'),
(60, 14, '2024-09-07', 0, 0, 470, 400, 15, 0, 0, 0, 'Lai cong ,lưng nhăn,px đứt chỉ'),
(61, 10, '2024-09-09', 0, 0, 720, 670, 71, 0, 0, 0, 'Cổ sụp mí thành phẩm sụp mí , lầ i đít chỉ ,dầu80%'),
(62, 9, '2024-09-09', 0, 0, 435, 431, 42, 0, 0, 0, 'nách nhăn+vặn,diễu cổ to nhỏ+nhốt,trang trí thành phẩm ngược+xỏ sai'),
(63, 2, '2024-09-09', 0, 0, 1100, 800, 63, 0, 0, 0, 'lưng nhăn+đùng+xì+sụp mí,pasan xiên+le chân,đáp túi sau đứt chỉ'),
(64, 12, '2024-09-09', 0, 0, 550, 465, 46, 0, 0, 0, 'lai lè,lưng bỏ mũi,bao túi sau giật(bẩn25%)'),
(65, 13, '2024-09-09', 0, 0, 530, 440, 43, 0, 0, 0, 'lưng xì,lai cong,lưng lệch nhãn(bẩn45%)'),
(66, 7, '2024-09-09', 0, 0, 365, 367, 32, 0, 0, 0, 'nách kẹp,mic tà xiên'),
(67, 11, '2024-09-09', 0, 0, 970, 950, 91, 0, 0, 0, 'Nách bỏ mủi,thành phẩm nhăn,lai bỏ mủi'),
(68, 6, '2024-09-09', 0, 0, 650, 636, 63, 0, 0, 0, 'lưng xì+kẹp,lai đứt chỉ+không trùng chỉ,quần phấn bẩn'),
(69, 5, '2024-09-09', 0, 0, 350, 345, 28, 0, 0, 0, 'lưng hở leo mí. nút lệch.vs sườn đứt chỉ'),
(70, 4, '2024-09-09', 0, 0, 300, 290, 22, 0, 0, 0, 'pa gết cong,lưng leo mi,passan xiên'),
(71, 16, '2024-09-09', 0, 0, 620, 570, 55, 0, 0, 0, 'Nhãn sai xì ,\r\nLai lệch sướn sai,\r\nDiển túi sau đứt chỉ( hàng bẩn85%)'),
(72, 15, '2024-09-09', 0, 0, 570, 520, 54, 0, 0, 0, 'Chốt px đứt chỉ,lưng xì+đứt chỉ,lai trong xì,bẩn 15%'),
(73, 14, '2024-09-09', 0, 0, 500, 400, 44, 0, 0, 0, 'Lưng nhăn+đứt chỉ,px đứt chỉ,lai đứt chỉ,lai lỏng chỉ,bẩn 6%'),
(74, 3, '2024-09-09', 0, 0, 710, 700, 71, 0, 0, 0, 'sườn tay - cổ sụp mí,sườn tay đứt chỉ, bo tay nhăn'),
(75, 8, '2024-09-09', 0, 0, 365, 365, 33, 0, 0, 0, 'Chân cổ nhăn vặn.'),
(76, 11, '2024-09-10', 0, 0, 970, 900, 77, 106235, 105764, 0, 'Thân sau bỏ mủi,nách nhăn'),
(77, 5, '2024-09-10', 0, 0, 350, 43, 4, 8910, 8658, 0, 'nút lệch'),
(78, 12, '2024-09-10', 0, 0, 550, 465, 46, 6871, 6160, 0, 'nhãn lưng xì,lai xì,bao túi sau giật(bẩn30%)'),
(79, 13, '2024-09-10', 0, 0, 530, 450, 43, 6494, 6035, 0, 'lưng bỏ mũi,lưng lệch nhãn,chốt lưng không trùng chỉ(bẩn45%)'),
(80, 7, '2024-09-10', 0, 0, 365, 365, 33, 4393, 4055, 0, 'cổ cao thấp,bo tay lỗ kim'),
(81, 4, '2024-09-10', 0, 0, 300, 300, 23, 3145, 2939, 0, 'psan xiên,pa gết cong,nút lệch'),
(82, 2, '2024-09-10', 0, 0, 1100, 800, 63, 11672, 10528, 0, 'lưng kẹp+xì+nhăn+bỏ mũi,bao túi sau đùng ,pasan xiên+le chân'),
(83, 6, '2024-09-10', 0, 0, 650, 635, 65, 9901, 9158, 0, 'lai cong+ đứt chỉ+ko trùng chỉ,lưng nhăn+xì+kẹp,bọ thành phẩm thiếu+xiên lè'),
(84, 8, '2024-09-10', 0, 0, 365, 365, 33, 2183, 2044, 0, 'Cổ nhăn, khuy bỏ mũi'),
(85, 3, '2024-09-10', 0, 0, 710, 700, 70, 14213, 12366, 0, 'sườn tay đứt chỉ, cổ sụp mí,lai đứt chỉ'),
(86, 9, '2024-09-10', 0, 0, 435, 430, 36, 42183, 41950, 0, 'viền cổ to nhỏ+sụp mí trong,thành phẩm to nhỏ,nhãn sườn kẹp+thiếu'),
(87, 16, '2024-09-10', 0, 0, 620, 570, 53, 5979, 5528, 0, 'Vắt sổ đáy rút chỉ. Đứt chỉ,\r\nLai đứt chỉ.(hàng bẩn80%),\r\nDiểu bao túi sau đứt chỉ'),
(88, 15, '2024-09-10', 0, 0, 570, 530, 51, 5388, 4534, 0, 'Lưng xì+bỏ mũi+kẹp dây dệt, bọ px bỏ mũi xiên kẹp, bẩn 15%'),
(89, 14, '2024-09-10', 0, 0, 500, 400, 46, 4227, 3215, 0, 'Lưng kẹp xì bỏ mũi,lai xì vặn,bẩn 6%'),
(90, 10, '2024-09-10', 0, 0, 720, 670, 75, 42449, 41111, 0, 'Cỗ sụp mí ,nhăn vặn, lai sụp mí đít chỉ.áo dầu 90%'),
(91, 17, '2024-09-10', 0, 0, 200, 180, 14, 180, 0, 0, 'nút lệch.lưng leo mí hở mí. diểu btui đứt chỉ'),
(92, 4, '2024-09-11', 0, 0, 320, 305, 24, 3450, 3252, 4731, 'nút lệch,lưng leo mí,pa gết cong,thân trước to nhỏ'),
(93, 8, '2024-09-11', 0, 0, 365, 365, 35, 2548, 2378, 3874, 'Lai kẹp to nhỏ.'),
(94, 7, '2024-09-11', 0, 0, 365, 336, 35, 4729, 4291, 5839, 'nhựa cổ lệch,ve rút chỉ'),
(95, 3, '2024-09-11', 0, 0, 710, 582, 58, 14795, 13030, 15598, 'sườn tay đứt chỉ,lai đứt chỉ,bo tay sụp mí'),
(96, 9, '2024-09-11', 0, 0, 430, 432, 35, 42615, 42460, 43296, 'thun cổ dài+to,diễu cổ to nhỏ +gãy,bo tay đứt chỉ+bỏ mũi'),
(97, 2, '2024-09-11', 0, 0, 1100, 724, 59, 12396, 11894, 15214, 'lưng nhăn+kẹp+xì+sụp mí,bao túi sau nhăn+đùng ,passan xiên+le chân+dài'),
(98, 6, '2024-09-11', 0, 0, 650, 635, 67, 10536, 9896, 10850, 'nút xiên chữ,lai xì+ ko trùng chỉ,bao túi lỏng chỉ+bỏ mũi'),
(99, 12, '2024-09-11', 0, 0, 550, 465, 52, 7336, 6620, 7120, 'lai cong.bỏ mủi,nhãn lưng xiên.xì,bọ bách xăng rối chỉ.(bẩn60%)'),
(100, 13, '2024-09-11', 0, 0, 530, 460, 46, 6954, 6495, 6528, 'lưng lệch nhãn,lai cong vặn,lưng xì.bỏ mũi(bẩn50%)'),
(101, 17, '2024-09-11', 0, 0, 250, 250, 23, 430, 145, 266, 'pasan lật dx.lưng kẹp túi leo mí hở mí lệch sườn. nút lệch.'),
(102, 11, '2024-09-11', 0, 0, 970, 900, 74, 107135, 106564, 106069, 'Họng cổ cao thấp, gá dây kéo túi ngực xì'),
(103, 10, '2024-09-11', 0, 0, 720, 670, 68, 43119, 41791, 41173, 'Cổ sụp mi ,nhăn.lai sụp mí đít chỉ ,tay vặn ,dầu số 90%'),
(104, 14, '2024-09-11', 0, 0, 500, 400, 45, 4627, 3600, 4044, 'Lưng nhăn xì,lai lỏng chỉ vặn,bẩn 6%'),
(105, 15, '2024-09-11', 0, 0, 570, 530, 51, 5918, 5064, 4574, 'Lưng xì bỏ mũi đứt chỉ,lai xì vặn bỏ mũi,bao túi đứt chỉ,bẩn 20%'),
(106, 16, '2024-09-11', 0, 0, 620, 570, 49, 6549, 6058, 6063, 'Lưng kẹp bao túi,\r\nVắt sổ sườn đứt chỉ, \r\nLai long chỉ ( bẩn 80%)');
