<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
        'ngayxong',
        'dot'
    ];
    public function kcs(): HasMany
    {
        return $this->hasMany(KCS::class);
    }
    public function btp(): HasMany
    {
        return $this->hasMany(BTP::class);
    }
    public function btp_day()
    {
        return $this->hasManyThrough(BTPDay::class, BTP::class, "plan_id", "btp_id");
    }
}
