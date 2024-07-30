<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->string('commenter_name', 100);
            $table->text('content');
            $table->unsignedBigInteger('post_id');
            $table->timestamps();

            // Foreign key
            $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
        });

        Schema::create('post_comment', function (Blueprint $table) {
            $table->unsignedBigInteger('post_id');
            $table->unsignedBigInteger('comment_id');

            $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
            $table->foreign('comment_id')->references('id')->on('comments')->onDelete('cascade');

            $table->primary(['post_id', 'comment_id']);
        });
    }

    public function down() {
        Schema::dropIfExists('post_comment');
        Schema::dropIfExists('comments');
    }
};