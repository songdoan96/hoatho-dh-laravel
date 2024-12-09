<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('finished', function (Blueprint $table) {
            $table->id();
            $table->string('khachhang');
            $table->string('mahang');
            $table->string('po');
            $table->string('size')->nullable();
            $table->string('mau')->nullable();
            $table->unsignedInteger('slkh');
            $table->unsignedInteger('danhap')->default(0);
            $table->unsignedInteger('dadong')->default(0);
            $table->unsignedInteger('sothung')->default(0);
            $table->enum('final', [0, 1, 2])->default(0);
            $table->date('ngay_final')->nullable();
            $table->date('ngay_xuat')->nullable();
            $table->string('vitri')->nullable();
            $table->boolean('daxuat')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('finished');
    }
};
