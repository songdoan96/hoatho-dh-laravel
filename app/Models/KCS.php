<?php

namespace App\Models;

class KCS extends BaseModel
{

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
        "ghichu"
    ];
    public function plans()
    {
        return $this->belongsTo(Plan::class, "plan_id", "id");
    }
}
