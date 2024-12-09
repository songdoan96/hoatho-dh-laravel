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
        'final',
        'date_final',
        'date_shipment',
        'vitri'
    ];
}
