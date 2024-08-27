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
        Schema::create('simples', function (Blueprint $table) {
            $table->id();
            $table->string('khachhang', 30)->nullable();
            $table->string('mahang', 30)->nullable();
            $table->string('loaimau', 20)->nullable();
            $table->string('color', 30)->nullable();
            $table->string('size', 30)->nullable();
            $table->unsignedSmallInteger('soluong');
            $table->date('npl')->nullable();
            $table->date('rap')->nullable();
            $table->date('tailieu')->nullable();
            $table->date('maugoc')->nullable();
            $table->string('ktmay')->nullable();
            $table->string('kcs')->nullable();
            $table->date('ngaymay')->nullable();
            $table->date('ngayhen')->nullable();
            $table->date('ngaygui')->nullable();
            $table->enum('tinhtrang', ['dangmay', 'dagui'])->default('dangmay');
            $table->enum('ketqua', ['pending', 'failed', 'passed'])->default('pending');
            $table->string('tuan', 10)->nullable();
            $table->boolean('bienban')->default(false);


            $table->date('ngaycmt')->nullable();
            $table->date('ngayguilai')->nullable();
            $table->string('thaydoi')->nullable();
            $table->string('tralaiinfo')->nullable();

            $table->string('ghichu')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('simples');
    }
};
