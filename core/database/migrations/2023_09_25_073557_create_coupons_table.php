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
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->string('coupon_name');
            $table->string('coupon_code')->unique();
            $table->tinyInteger('type')->default(1);
            $table->integer('discount_value');
            $table->integer('min_purchase');
            $table->integer('max_discount')->nullable();
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->integer('qty')->nullable();
            $table->integer('used_qty')->default(0);
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coupons');
    }
};
