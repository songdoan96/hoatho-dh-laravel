<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BTP extends Model
{
    use HasFactory;
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
