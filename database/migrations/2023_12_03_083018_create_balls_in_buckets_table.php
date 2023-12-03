<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('balls_in_buckets', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('ball_id');
            $table->uuid('bucket_id');
            $table->integer('amount')->default(0)->nullable()->comment('Number of Balls');
            $table->foreign('ball_id')->references('id')->on('balls');
            $table->foreign('bucket_id')->references('id')->on('buckets');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('balls_in_buckets');
    }
};
