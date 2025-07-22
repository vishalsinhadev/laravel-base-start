<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('post_files', function (Blueprint $table) {
            $table->id();
            $table->string('file_type')->nullable();    // e.g., 'image', 'video'
            $table->string('file_name');                // file name or path
            $table->unsignedBigInteger('post_id');      // linked post
            $table->boolean('is_flipped')->default(false);
            $table->boolean('is_rotated')->default(false);
            $table->string('thumb')->nullable();        // thumbnail image
            $table->integer('priority')->default(0);    // for ordering
            $table->integer('file_width')->nullable();  // original width
            $table->integer('file_height')->nullable(); // original height
            $table->softDeletes();                      // adds deleted_at
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('post_files');
    }
};
