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
        Schema::create('feedbacks', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('branch_id')->nullable();
            $table->string('zone_id')->nullable();
            $table->string('place_id')->nullable();
            $table->string('category_id')->nullable();
            $table->string('title_id')->nullable();
            $table->string('feedback_to')->nullable();
            $table->string('description')->nullable();
            $table->string('status')->nullable();
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('feebacks');
    }
};
