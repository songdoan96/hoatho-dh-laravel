<?php

namespace App\Models;


class BTPDay extends BaseModel
{
    protected $table = "btp_day";

    public $timestamps = false;
    protected $fillable = [
        "btp_id",
        "slcat",
        "slcap",
        "ngay"
    ];
    public function btp()
    {
        return $this->belongsTo(BTP::class, "btp_id", "id");
    }
    public function plan()
    {
        return $this->hasOneThrough(Plan::class, BTP::class, 'id', 'id', 'btp_id', 'plan_id');
    }
}
