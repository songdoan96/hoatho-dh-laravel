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
        Schema::create('btp', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("plan_id");
            $table->string("size")->nullable();
            $table->string("color")->nullable();
            $table->unsignedMediumInteger("slkh");
            $table->foreign(columns: 'plan_id')->references('id')->on('plans');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('btp');
    }
};
