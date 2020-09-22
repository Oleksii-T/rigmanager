<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // id of user
            $table->boolean('is_banned')->default(false);
            $table->string('name', 255); //name of user
            $table->string('phone_raw', 11)->nullable(); //phone number of user
            $table->boolean('viber')->default(false);
            $table->boolean('telegram')->default(false);
            $table->boolean('whatsapp')->default(false);
            $table->string('email', 255)->unique(); // login email for user
            $table->timestamp('email_verified_at')->nullable(); //date when user confirms his email
            $table->string('password', 255); // password hash
            $table->string('language', 2)->default('uk'); // password hash
            $table->rememberToken(); //Adds a nullable remember_token VARCHAR(100) equivalent column.
            $table->timestamps(); // Adds nullable created_at and updated_at TIMESTAMP equivalent columns with precision (total digits).
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
        Schema::dropIfExists('users');
    }
}
