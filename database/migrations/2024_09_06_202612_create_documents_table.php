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
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->string('bophan')->nullable();
            $table->string('sttbophan')->nullable();
            $table->string('vanbanso')->nullable();
            $table->string('danhmuc')->nullable();
            $table->string('phanloai')->nullable();
            $table->string('ngaybanhanh')->nullable();
            $table->string('ngaysuadoi')->nullable();
            $table->unsignedSmallInteger('lansuadoi')->nullable()->default(0);
            $table->string('thoigianluu')->nullable();
            $table->string('noiluutru')->nullable();
            $table->string('ghichu')->nullable();
            $table->string('link')->nullable();
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};
