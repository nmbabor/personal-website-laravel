<?php

use App\Models\PortfolioCategory;
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
        Schema::create('portfolios', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('git_url')->nullable();
            $table->string('live_url')->nullable();
            $table->foreignIdFor(PortfolioCategory::class)->constrained();
            $table->string('client_name')->nullable();
            $table->string('project_date')->nullable();

            $table->string('thumbnail')->nullable();
            $table->string('yt_video_id')->nullable();

            $table->longText('description');
            $table->text('meta_description')->nullable();
            $table->text('meta_tags')->nullable();

            $table->integer('created_by');
            $table->tinyInteger('status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('portfolios');
    }
};
