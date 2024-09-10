<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;
    protected $fillable = ['bophan', 'sttbophan', 'vanbanso', 'danhmuc', "phanloai", "ngaybanhanh", "ngaysuadoi", "lansuadoi", "thoigianluu", "noiluutru",  'ghichu', 'link'];
    public $timestamps = false;
}
