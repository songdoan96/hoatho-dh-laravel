<?php

namespace App\Imports;

use App\Models\Finished;
use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class FinishedImport implements ToModel, SkipsEmptyRows, WithHeadingRow, WithValidation
{
    /**
     * @param array $row
     *
     * @return Model|null
     */
    public function model(array $row)
    {
        return new Finished([
            //
        ]);
    }

    public function rules(): array
    {
        return [
            "khach_hang" => 'required',
            "ma_hang" => 'required',
            "mau" => 'required',
            "size" => 'required',
            "po" => 'required',
            "slkh" => 'required',
        ];
    }
}
