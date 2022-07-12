<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
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
            // $table->foreign('user_info_id')->references('id')->on('user_infos'); // to create table first
            $table->string('name'); // to delete since it is already included in user_infos table
            $table->string('username', 20)->unique();
            $table->string('email', 255)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password', 60);
            $table->char('role', 20);
            $table->rememberToken();
            // $table->foreign('charitable_organization_id')->references('id')->on('charitable_organizations')->nullable(); // to create table first
            $table->char('status', 20);
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
};
