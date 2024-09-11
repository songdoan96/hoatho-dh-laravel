<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class KCS extends Model
{
    use HasFactory;

    //    const UPDATED_AT = null;
    protected $table = "kcs";
    public $timestamps = false;
    protected $fillable = [
        "plan_id",
        "ngaytao",
        "laodong",
        "duphong",
        "chitieungay",
        "sldat",
        "slloi",
        "chitietloi",
        "thuchien",
        "nhaphoanthanh",
        "btpcap",
    ];
    public function plans(): BelongsTo
    {
        return $this->belongsTo(Plan::class, "plan_id", "id");
    }
}
