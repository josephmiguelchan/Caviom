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
        Schema::create('benefactors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('charitable_organization_id')->references('id')->on('charitable_organizations')->constrained();
            $table->uuid('code');
            $table->string('profile_photo', 255)->nullable();
            $table->text('first_name');
            $table->text('last_name');
            $table->text('middle_name')->nullable();
            $table->text('email_address');
            $table->text('cel_no');
            $table->text('tel_no')->nullable();
            $table->foreignId('address_id')->references('id')->on('addresses')->constrained();
            $table->text('category')->nullable();
            $table->text('label')->nullable();
            $table->foreignId('last_modified_by_id')->nullable()->references('id')->on('users')->constrained();
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
        Schema::dropIfExists('benefactors');
    }
};
