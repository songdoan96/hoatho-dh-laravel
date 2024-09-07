<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;
    protected $fillable = ['bophan', 'stt', 'vanbanso', 'danhmuc', 'ghichu', 'link'];
    public $timestamps = false;
}
