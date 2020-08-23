<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->string('title', 255);
            $table->string('condition', 255);
            $table->string('tag_encoded', 255);
            $table->text('description', 9000);
            $table->string('cost', 255)->nullable();
            $table->string('location', 255)->nullable();
            $table->string('user_email', 255)->nullable();
            $table->string('user_phone', 255)->nullable();
            $table->boolean('viber')->default(false);
            $table->boolean('telegram')->default(false);
            $table->boolean('whatsapp')->default(false);
            $table->timestamps();
            $table->softDeletes('deleted_at', 0); // Adds a nullable deleted_at TIMESTAMP equivalent column for soft deletes with precision (total digits).
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
