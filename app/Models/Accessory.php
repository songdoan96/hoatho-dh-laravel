<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Accessory extends Model
{
    use HasFactory;
    protected $fillable = [
        "order_id",
        "het",
        "ngay",
        "day",
        "khachhang",
        "mahang",
        "loai",
        "mau",
        "size",
        "donvi",
        "po",
        "soluong",
        "nguoinhan",
        "ghichu",
    ];

    public function orders()
    {
        return $this->hasMany(Accessory::class, "order_id", "id");
    }

    public function accessory()
    {
        return $this->belongsTo(Accessory::class, "order_id", "id", Accessory::class);
    }

    public function ordersQty()
    {
        return $this->hasMany(Accessory::class, "order_id", "id")->sum("soluong");
    }
    public function totalQtyWithStyle()
    {
        return Accessory::where("het", false)
            ->where("mahang", $this->mahang)
            ->where("size", $this->size)
            ->where("mau", $this->mau)
            ->where("order_id", null)
            ->sum("soluong");
    }
    public function totalQtyOrderWithStyle()
    {
        return Accessory::where("order_id", "!=", null)
            ->where("het", false)
            ->where("khachhang", $this->khachhang)
            ->where("mahang", $this->mahang)
            ->where("size", $this->size)
            ->where("mau", $this->mau)
            ->sum("soluong");
    }

    public function totalQtyWithRow()
    {
        return Accessory::where("het", false)
            ->where("day", $this->day)
            ->where("mahang", $this->mahang)
            ->where("size", $this->size)
            ->where("mau", $this->mau)
            ->where("order_id", null)
            ->sum("soluong");
    }
    public function totalQtyOrderWithRow()
    {
        return Accessory::where("het", false)
            ->where("day", $this->day)
            ->where("khachhang", $this->khachhang)
            ->where("mahang", $this->mahang)
            ->where("size", $this->size)
            ->where("mau", $this->mau)
            ->where("order_id", "!=", null)
            ->sum("soluong");
    }
}
