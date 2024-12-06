<?php

namespace App\Imports;

use App\Models\BTP;
use App\Models\BTPDay;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class BTPLineImport implements ToModel, SkipsEmptyRows, WithHeadingRow, WithValidation
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {

        if ($row["id"] != "" && $row["mau"] != "" && $row["size"] != "" && $row["slkh"] != "" && $row["sl_cat"] != "" && $row["sl_cap"] != "") {
            $btpDayExist = BTPDay::where("btp_id", $row["id"])
                ->where('ngay', $row["ngay"])->first();
            if ($btpDayExist) {
                $btpDayExist->update([
                    // "btp_id" => $row["id"],
                    // "ngay" => date("Y-m-d", $row["ngay"]),
                    "slcat" => (float)$row["sl_cat"] ?: 0,
                    "slcap" => (float)$row["sl_cap"] ?: 0,
                ]);
                return;
            } else {
                return new BTPDay([
                    "btp_id" => $row["id"],
                    "ngay" => is_string($row["ngay"]) ? $row["ngay"] : Date::excelToDateTimeObject($row["ngay"])->format("Y-m-d"),
                    "slcat" => (float)$row["sl_cat"] ?: 0,
                    "slcap" => (float)$row["sl_cap"] ?: 0,
                ]);
            }
        }
    }
    public function rules(): array
    {
        return [
            "mau" => 'required',
            "size" => 'required',
            "slkh" => 'required',
        ];
    }
}
