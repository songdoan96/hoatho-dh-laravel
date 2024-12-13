<?php

namespace App\Models;

class Document extends BaseModel
{
    protected $fillable = ['bophan', 'sttbophan', 'vanbanso', 'danhmuc', "phanloai", "ngaybanhanh", "ngaysuadoi", "lansuadoi", "thoigianluu", "noiluutru",  'ghichu', 'link'];
    public $timestamps = false;
}
