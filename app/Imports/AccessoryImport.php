<?php

namespace App\Imports;

use Carbon\Carbon;
use App\Models\Accessory;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToModel;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class AccessoryImport implements ToModel, SkipsEmptyRows, WithHeadingRow, WithValidation
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    use Importable;
    public function model(array $row)
    {
        if ($row["ngay"] != "") {
            return new Accessory([
                "ngay" => Carbon::instance(Date::excelToDateTimeObject($row["ngay"]))->format("Y-m-d"),
                "khachhang" => trim(Str::upper($row["khach_hang"])),
                "mahang" => trim(Str::upper($row["ma_hang"])),
                "loai" => trim((string)$row["loai"]),
                "day" => trim((string)$row["day"]),
                "mau" => trim((string)$row["mau"] ?: null),
                "size" => trim((string)$row["size"] ?: null),
                "donvi" => trim((string)$row["don_vi"]),
                "po" => trim((string)$row["po"]),
                "soluong" => (float)$row["so_luong"],
                "ghichu" => (string)$row["ghi_chu"]
            ]);
        }
    }

    public function rules(): array
    {
        return [
            "ngay" => 'required',
            "khach_hang" => 'required',
            "ma_hang" => 'required',
            "loai" => 'required',
            "day" => 'required',
            "don_vi" => 'required',
            "so_luong" => 'required',
        ];
    }
}
