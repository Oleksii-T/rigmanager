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
            $table->boolean('is_banned')->default(false);
            $table->boolean('is_active')->default(true);
            $table->integer('thread');
            $table->string('title', 255);
            $table->string('company', 255)->nullable(); //company name
            $table->string('type', 2); // sell/buy/loan
            $table->string('role', 2); // private/bussiness
            $table->integer('condition')->nullable();
            $table->string('tag_encoded', 255);
            $table->text('description', 9000);
            $table->double('cost', 50, 2)->nullable();
            $table->string('currency', 4)->nullable();
            $table->string('region_encoded', 10)->nullable();
            $table->string('town', 255)->nullable();
            $table->string('user_email', 255)->nullable();
            $table->string('user_phone_raw', 11)->nullable();
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
