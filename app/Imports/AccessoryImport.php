<?php

namespace App\Imports;

use App\Models\Accessory;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class AccessoryImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        if ($row["ngay"] != "") {
            return new Accessory([
                "ngay" => Carbon::instance(Date::excelToDateTimeObject($row["ngay"]))->format("Y-m-d"),
                "khachhang" => (string)$row["khach_hang"],
                "mahang" => (string)$row["ma_hang"],
                "loai" => (string)$row["loai"],
                "day" => (string)$row["day"],
                "mau" => (string)$row["mau"],
                "size" => (string)$row["size"],
                "donvi" => (string)$row["don_vi"],
                "po" => (string)$row["po"],
                "soluong" => (float)$row["so_luong"],
                "ghichu" => (string)$row["ghi_chu"]
            ]);
        }
    }
}
