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
        Schema::create('profile_primary_infos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('charitable_organization_id')->references('id')->on('charitable_organizations')->constrained();
            $table->string('category', 128);
            $table->string('tagline', 255)->nullable();
            $table->foreignId('address_id')->references('id')->on('addresses')->constrained();
            $table->string('email_address', 128)->nullable();
            $table->char('cel_no', 20)->nullable();
            $table->char('tel_no', 20)->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profile_primary_infos');
    }
};
