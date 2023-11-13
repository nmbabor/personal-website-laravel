<?php

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
        Schema::create('link_submits', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->json('links');
            $table->integer('total_links');
            $table->integer('total_credits');
            $table->foreignIdFor(User::class);
            $table->tinyInteger('status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('link_submits');
    }
};
