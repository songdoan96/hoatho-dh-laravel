<?php

namespace App\Exports;

use App\Models\Simple;
use Maatwebsite\Excel\Concerns\FromCollection;

use Maatwebsite\Excel\Concerns\WithHeadings;

class SimplesExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public $data;
    public function __construct($data)
    {
        $this->data = $data;
    }
    public function headings(): array
    {
        return [
            "STT",
            "Khách hàng",
            "Mã hàng",
            "Loại mẫu",
            "Màu",
            "Size/Dàn",
            "Số lượng",
            "NPL",
            "Rập",
            "Tài liệu",
            "Mẫu gốc",
            "KT may",
            "KCS",
            "Ngày may",
            "Ngày hẹn",
            "Ngày gửi",
            "Tình trạng",
            "Kết quả",
            "Tuần",
            "Biên bản",
            "Ngày comment",
            "Ngày gửi lại",
            "Thay đổi khi may",
            "Size, màu trả lại",
            "Ghi chú",
        ];
    }

    public function collection()
    {
        return collect($this->data)->map(function ($item) {
            $item['tinhtrang'] = $item['tinhtrang'] === "dangmay" ? "Đang may" : "Đã gửi";
            $item['ketqua'] = $item['ketqua'] === "passed" ? "PASSED" : ($item['ketqua'] === "failed" ? "FAILED" : "--");
            $item['bienban'] = $item['bienban'] === 1 ? "Đã có" : "Chưa có";
            unset($item['created_at']);
            return $item;
        });
    }
}
