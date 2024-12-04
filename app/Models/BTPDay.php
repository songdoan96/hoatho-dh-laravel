<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BTPDay extends Model
{
    use HasFactory;
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
}
