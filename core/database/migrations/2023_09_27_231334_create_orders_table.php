<?php

use App\Models\PricingPlan;
use App\Models\User;
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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_no');
            $table->foreignIdFor(User::class);
            $table->foreignIdFor(PricingPlan::class);
            $table->integer('credits');
            $table->integer('link_submit');
            $table->string('payment_method');
            $table->integer('total_amount');
            $table->integer('discount')->nullable();
            $table->string('discount_code')->nullable();
            $table->string('trans_id')->nullable();
            $table->string('payer_email')->nullable();
            $table->string('others_info')->nullable();
            $table->string('pop_photo')->nullable(); //proof of payment
            $table->tinyInteger('is_paid')->default(0);
            $table->unsignedBigInteger('verified_by')->nullable();
            $table->foreign('verified_by')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
