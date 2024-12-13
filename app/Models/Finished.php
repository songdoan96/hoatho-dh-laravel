<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Finished extends BaseModel
{
    protected $table = "finished";

    protected $fillable = [
        'khachhang',
        'mahang',
        'po',
        'size',
        'mau',
        'slkh',
        'danhap',
        'dadong',
        'sothung',
        'ngay_prefinal',
        'prefinal',
        'ngay_final',
        'final',
        'ngay_xuat',
        'vitri',
        'kichthung'
    ];
    protected static function boot()
    {
        parent::boot();
        static::saving(function ($model) {
            foreach ($model->attributes as $key => $value) {
                if (is_string($value)) {
                    $model->attributes[$key] = strtoupper(trim($value));
                }
            }
        });
    }
}
