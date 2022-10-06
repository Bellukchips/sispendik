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
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('id_users')->unique();
            $table->string('password');
            $table->rememberToken();
            $table->string('photo')->nullable();
            $table->string('api_token')->nullable();
            $table->char('role',1)->comment('0 : superadmin','1 : admin','2 : student','3 : employee','4 : finance');
            $table->boolean('status')->default(false);
            $table->boolean('status_online')->default(false);
            $table->timestamp('time_online')->nullable();
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
