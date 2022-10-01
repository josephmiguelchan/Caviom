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
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->uuid('code');
            $table->foreignId('user_id')->nullable()->constrained();
            $table->char('read_status', 20)->default('unread');
            $table->string('category', 64)->nullable();
            $table->string('subject', 64);
            $table->string('message', 512)->nullable();
            $table->string('icon', 64)->nullable();
            $table->char('color', 20)->nullable();
            $table->timestamp('created_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notifications');
    }
};
