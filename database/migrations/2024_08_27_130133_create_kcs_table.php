<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

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
            $table->date('ngaytao')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->unsignedFloat('laodong', 5, 2)->default(0);
            $table->unsignedFloat('duphong', 5, 2)->default(0);
            $table->unsignedSmallInteger('chitieungay')->default(0);
            $table->unsignedSmallInteger('sldat')->default(0);
            $table->unsignedSmallInteger('slloi')->default(0);


            $table->unsignedMediumInteger('thuchien')->default(0);
            $table->unsignedMediumInteger('nhaphoanthanh')->default(0);
            $table->unsignedMediumInteger('btpcap')->default(0);



            $table->string('chitietloi')->nullable();
            $table->string('ghichu')->nullable();
            //            $table->timestamp('created_at')->useCurrent();
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
