<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('followers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('follewers_id'); // note: seems like a typo, should be `follower_id`?
            $table->unsignedBigInteger('user_id');
            $table->softDeletes(); // adds deleted_at
            $table->timestamps();

            // Optional foreign keys (if users table exists)
            $table->foreign('follewers_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            // Optional index for efficient queries
            $table->index(['user_id', 'follewers_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('followers');
    }
};
