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
        Schema::create('plans', function (Blueprint $table) {
            $table->id();
            $table->string('chuyen', 6);
            $table->string('khachhang');
            $table->string('mahang');
            $table->string('logo')->nullable();
            $table->date('ngaydukien');
            $table->date('ngayrai')->nullable();
            $table->unsignedMediumInteger('sltacnghiep');
            $table->boolean('daraichuyen')->default(false);
            $table->unsignedMediumInteger('thuchien')->default(0);
            $table->unsignedMediumInteger('nhaphoanthanh')->default(0);
            $table->float('mucvon')->default(0);
            $table->string('ghichu')->nullable();
            $table->boolean('daxong')->default(false);
            $table->timestamp('created_at')->useCurrent();
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plans');
    }
};
