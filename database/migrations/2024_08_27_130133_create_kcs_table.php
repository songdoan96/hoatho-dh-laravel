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
        Schema::create('kcs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('plan_id');
            $table->unsignedSmallInteger('laodong')->default(0);
            $table->unsignedSmallInteger('duphong')->default(0);
            $table->unsignedSmallInteger('chitieungay')->default(0);
            $table->unsignedSmallInteger('sldat')->default(0);
            $table->unsignedSmallInteger('slloi')->default(0);
            $table->string('chitietloi')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->foreign('plan_id')->references('id')->on('plans');
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kcs');
    }
};
