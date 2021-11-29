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
            $table->id();
            $table->string('name');
            $table->string('email')->unique();

            // for simplicity this information stored here
            $table->string('google_client_id')->nullable();
            $table->string('google_client_secret')->nullable();
            $table->string('google_sheet_id')->nullable();
            $table->json('google_oauth_token')->nullable();

            $table->string('zoho_client_id')->nullable();
            $table->string('zoho_client_secret')->nullable();
            $table->json('zoho_oauth_token')->nullable();

            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
