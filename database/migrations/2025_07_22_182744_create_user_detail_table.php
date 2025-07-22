<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('user_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->unique(); // One-to-one relation
            $table->string('filter')->nullable();
            $table->string('category')->nullable();
            $table->text('private_description')->nullable();
            $table->string('privete_profile_url')->nullable(); // typo?
            $table->string('private_url1')->nullable();
            $table->string('private_url2')->nullable();
            $table->string('private_url3')->nullable();
            $table->string('profile_image_url')->nullable();
            $table->text('description')->nullable();
            $table->string('image_url1')->nullable();
            $table->string('image_url2')->nullable();
            $table->string('image_url3')->nullable();
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_details');
    }
};
