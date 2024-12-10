<?php

namespace App\Exports;

use App\Models\Plan;
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
        // return Plan::where('daxong', 0)
        //     ->where('daraichuyen', 1)
        //     ->orderBy('chuyen')
        //     ->with('btp_day')
        //     ->get();
        return BTPDay::with("plan")
            ->get()
            ->where('plan.daxong', 0)
            ->where('plan.daraichuyen', 1)
            ->sortBy('plan.chuyen');
    }
    public function headings(): array
    {
        return [
            "Chuyền",
            "Mã hàng",
            "Đợt",
            "Size",
            "Màu",
            "SLKH",
            "LK cắt",
            "LK cấp",
            "Ngày",
            "SL cắt",
            "SL cấp",
        ];
    }
    public function map($btpDay): array
    {
        dd($btpDay);
        return [
            $btpDay->plan->chuyen,
            $btpDay->plan->mahang,
            date("d-m-Y"),
            // $btpDay->btp->size,
            // $btpDay->btp->color,
            // $btpDay->btp->slkh,
            // $btpDay->slcat ?? 0,
            // BTPDay::where("btp_id", $btpDay->id)->sum("slcat"),
            // $btpDay->slcap ?? 0,
            // BTPDay::where("btp_id", $btpDay->id)->sum("slcap"),

        ];
    }
}
