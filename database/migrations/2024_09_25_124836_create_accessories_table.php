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
        Schema::create('accessories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("order_id")->nullable();
            $table->boolean("het")->default(0);
            $table->date("ngay");
            $table->string('day');
            $table->string('khachhang');
            $table->string(column: 'mahang');
            $table->string('loai');
            $table->string('mau')->nullable();
            $table->string('size')->nullable();
            $table->string('donvi');
            $table->string('po')->nullable();
            $table->unsignedDecimal("soluong", 10, 2);
            $table->string('nguoinhan')->nullable();
            $table->string('ghichu')->nullable();
            $table->foreign(columns: 'order_id')->references('id')->on('accessories');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accessories');
    }
};
