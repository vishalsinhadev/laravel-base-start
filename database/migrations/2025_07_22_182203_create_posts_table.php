<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('content')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->string('image')->nullable();
            $table->string('owner_name')->nullable();
            $table->text('decription')->nullable(); // Typo in your model - should be "description"?
            $table->string('tag')->nullable();
            $table->integer('filter')->nullable();
            $table->unsignedBigInteger('filter_id')->nullable(); // used in getByFilterAndFollower()
            $table->softDeletes(); // adds deleted_at column
            $table->timestamps();

            // Add foreign key constraint if needed
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
