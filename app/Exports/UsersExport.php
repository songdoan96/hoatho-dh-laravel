<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UsersExport implements FromCollection, WithHeadings
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
        return ["STT", "Tên tài khoản", "MK"];
    }
    public function collection()
    {
        return collect($this->data)->map(function ($item) {
            $item['id'] = $item['id'] + 1;
            return $item;
        });
    }
}
