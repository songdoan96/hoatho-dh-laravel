<?php

namespace App\Models;

class Simple extends BaseModel
{
    protected $fillable = [
        'khachhang',
        'mahang',
        'loaimau',
        'color',
        'size',
        'soluong',
        'npl',
        'rap',
        'tailieu',
        'maugoc',
        'ktmay',
        'kcs',
        'ngaymay',
        'ngayhen',
        'ngaygui',
        'tinhtrang',
        'ketqua',
        'tuan',
        'bienban',

        'ngaycmt',
        'ngayguilai',
        'thaydoi',
        'tralaiinfo',

        'ghichu',
    ];
    public function setTinhtrangAttribute($tinhtrang)
    {
        $this->attributes['tinhtrang'] = $tinhtrang ?? "dangmay";
    }
    public function setKetquaAttribute($ketqua)
    {
        $this->attributes['ketqua'] = $ketqua ?? "pending";
    }
    public function setBienbanAttribute($bienban)
    {
        $this->attributes['bienban'] = $bienban ?? false;
    }
}
