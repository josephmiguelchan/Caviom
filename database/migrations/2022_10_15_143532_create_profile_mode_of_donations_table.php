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
        Schema::create('profile_mode_of_donations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('charitable_organization_id')->references('id')->on('charitable_organizations')->constrained();
            $table->string('mode', 128);
            $table->string('account_name', 128);
            $table->string('account_no', 128);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profile_mode_of_donations');
    }
};
