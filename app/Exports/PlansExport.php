<?php

namespace App\Exports;

use App\Models\KCS;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class PlansExport implements FromCollection, WithHeadings, WithMapping
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public $date;
    public function __construct($date)
    {
        $this->date = $date;
    }
    public function headings(): array
    {
        return [
            "Ngày",
            "Chuyền",
            "Khách hàng",
            "Mã hàng",
            'Lao động',
            'Dự phòng',
            'LK tác nghiệp',
            'LK thực hiện',
            'LK nhập hoàn thành',
            'Nhập thiếu',
            'Chỉ tiêu ngày',
            'SL đạt',
            'TL thực hiện',
            'SL lỗi',
            'TL lỗi',
            'Vốn',
            'Vướng mắc'
        ];
    }
    public function map($kcs): array
    {
        return [
            $kcs->ngaytao,
            $kcs->plans->chuyen,
            $kcs->plans->khachhang,
            $kcs->plans->mahang,
            $kcs->laodong,
            $kcs->duphong,
            $kcs->plans->sltacnghiep,
            $kcs->plans->thuchien,
            $kcs->plans->nhaphoanthanh,
            $kcs->plans->thuchien - $kcs->plans->nhaphoanthanh,
            $kcs->chitieungay,
            $kcs->sldat,
            round(($kcs->sldat / $kcs->chitieungay) * 100, 1),
            $kcs->slloi,
            $kcs->sldat == 0 && $kcs->slloi == 0 ? 0 : round(($kcs->slloi / ($kcs->sldat + $kcs->slloi)) * 100, 1),
            round(abs(($kcs->plans->btpcap - $kcs->plans->nhaphoanthanh) / $kcs->chitieungay), 1),
            $kcs->chitietloi,

        ];
    }
    public function collection()
    {
        return KCS::where('ngaytao', date($this->date))->with('plans')->get()->sortBy('plans.chuyen');
    }
}
