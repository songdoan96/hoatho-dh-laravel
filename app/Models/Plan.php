<?php

namespace App\Models;

class Plan extends BaseModel
{
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
        'ngayxong',
        'dot'
    ];
    public function kcs()
    {
        return $this->hasMany(KCS::class);
    }
    public function btp()
    {
        return $this->hasMany(BTP::class);
    }
    public function btp_day()
    {
        return $this->hasManyThrough(BTPDay::class, BTP::class, "plan_id", "btp_id");
    }
}
