<?php

namespace App\Exports;

use App\Models\BTP;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class BTPExport implements FromCollection, WithHeadings, WithMapping
{
    public $plan;
    public function __construct($plan)
    {
        $this->plan = $plan;
    }
    public function collection()
    {
        return BTP::where("plan_id", $this->plan->id)->get();
    }

    public function headings(): array
    {
        return [
            "ID",
            "Ngày",
            "Chuyền",
            "Mã hàng",
            "Size",
            "Màu",
            "SLKH",
            "LK cắt",
            "LK cấp",
            "SL cắt",
            "SL cấp",
        ];
    }
    public function map($btp): array
    {
        return [
            $btp->id,
            date("Y-m-d"),
            $btp->plan->chuyen,
            $btp->plan->mahang,
            $btp->size,
            $btp->color,
            $btp->slkh,
            $btp->btpDay->sum("slcat") ?? 0,
            $btp->btpDay->sum("slcap") ?? 0,
            $btp->btpDay->where("btp_id", $btp->id)->where("ngay", date("Y-m-d"))->first()->slcat ?? 0,
            $btp->btpDay->where("btp_id", $btp->id)->where("ngay", date("Y-m-d"))->first()->slcap ?? 0,
        ];
    }
}
