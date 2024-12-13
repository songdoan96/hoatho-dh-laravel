<?php

namespace App\Models;

class BTP extends BaseModel
{
    protected $table = "btp";
    public $timestamps = false;

    protected $fillable = [
        "plan_id",
        "size",
        "color",
        "slkh",
        "status"
    ];
    public function plan()
    {
        return $this->belongsTo(Plan::class, "plan_id", "id");
    }
    public function btpDay()
    {
        return $this->hasMany(BTPDay::class, "btp_id");
    }
}
