<?php

namespace App\Imports;

use App\Models\BTP;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\Importable;

class BTPImport implements ToModel, SkipsEmptyRows, WithHeadingRow, WithValidation
{
    use Importable;
    private $plan_id;

    public function __construct($plan_id)
    {
        $this->plan_id = $plan_id;
    }
    public function model(array $row)
    {
        if ($row["mau"] != "" && $row["size"] != "" && $row["slkh"] != "") {
            return new BTP([
                "plan_id" => $this->plan_id,
                "color" => (string)$row["mau"] ?: null,
                "size" => (string)$row["size"] ?: null,
                "slkh" => (float)$row["slkh"] ?: 0,
            ]);
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
