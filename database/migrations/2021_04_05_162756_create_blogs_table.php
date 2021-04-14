<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->string('slug', 255);
            $table->json('author');
            $table->json('title');
            $table->json('intro')->nullable();
            $table->json('body')->nullable();
            $table->json('outro')->nullable();
            $table->string('thumbnail', 100);
            $table->json('imgs')->nullable();
            $table->json('docs')->nullable();
            $table->json('links')->nullable();
            $table->json('views')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blogs');
    }
}
