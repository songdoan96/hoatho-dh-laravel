<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;
    const UPDATED_AT = null;

    protected $fillable = [
        'chuyen',
        'khachhang',
        'mahang',
        'ngaydukien',
        'ngayrai',
        'sltacnghiep',
        'daraichuyen',
        'thuchien',
        'nhaphoanthanh',
        'mucvon',
        'ghichu',
        'daxong',
    ];
}
