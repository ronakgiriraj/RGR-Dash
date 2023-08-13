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
            $table->string('username')->unique();
            $table->string('mobile', 15)->unique()->nullable();
            $table->string('email')->unique()->nullable();
            $table->bigInteger('role_id')->unsigned();
            $table->string('bio', 255)->nullable();
            $table->string('avatar', 255)->nullable();
            $table->enum('status', ['active','pending','inactive'])->default('active');
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamp('last_seen')->nullable();
            $table->enum('last_seen_enabled', ['0','1'])->default('1');
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('restrict');
        });

        Artisan::call('db:seed', array('--class' => 'UserAndRolesSeeder'));
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
