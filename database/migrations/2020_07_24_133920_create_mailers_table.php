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
            $table->string('title', 255);
            $table->string('tag', 255)->nullable();
            $table->string('author', 100)->nullable(); 
            $table->string('keyword', 255)->nullable();
            $table->string('currency', 25)->nullable(); // UAH/USD
            $table->string('cost_from', 25)->nullable();
            $table->string('cost_to', 25)->nullable();
            $table->string('region', 255)->nullable();
            $table->string('condition', 25)->nullable(); // new/sh/parts
            $table->string('type', 25)->nullable(); // sell/buy/loan/leas/provide/reqeust/tender
            $table->string('role', 25)->nullable(); // business/private
            $table->string('thread', 25)->nullable(); // eq/se
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
