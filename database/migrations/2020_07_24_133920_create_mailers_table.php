<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMailersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mailers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->string('types', 15); // sell/buy/loan
            $table->string('eq_tags_encoded', 255)->nullable();
            $table->string('se_tags_encoded', 255)->nullable();
            $table->string('keywords', 255)->nullable();
            $table->string('authors_encoded', 255)->nullable();
            $table->boolean('is_active')->default(true);
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
        Schema::dropIfExists('mailers');
    }
}
