<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('btp_day', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('btp_id');
            $table->unsignedMediumInteger("slcat")->default(0);
            $table->unsignedMediumInteger("slcap")->default(0);
            $table->foreign(columns: 'btp_id')->references('id')->on('btp');
            $table->date('ngay')->default(DB::raw("CURRENT_TIMESTAMP"));
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('btp_day');
    }
};
