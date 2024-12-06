<?php

namespace App\Exports;

use App\Models\BTPDay;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class BTPDayExport implements FromCollection, WithHeadings, WithMapping
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return BTPDay::where("ngay", date("Y-m-d"))->get();
    }
    public function headings(): array
    {
        return [
            "Ngày",
            "Chuyền",
            "Mã hàng",
            "Size",
            "Màu",
            "SLKH",
            "SL cắt",
            "LK cắt",
            "SL cấp",
            "LK cấp",
        ];
    }
    public function map($btpDay): array
    {
        return [
            formatDate($btpDay->ngay, "d-m-Y"),
            $btpDay->plan->chuyen,
            $btpDay->plan->mahang,
            $btpDay->btp->size,
            $btpDay->btp->color,
            $btpDay->btp->slkh,
            $btpDay->slcat ?? 0,
            BTPDay::where("btp_id", $btpDay->id)->sum("slcat"),
            $btpDay->slcap ?? 0,
            BTPDay::where("btp_id", $btpDay->id)->sum("slcap"),

        ];
    }
}
