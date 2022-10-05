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
        Schema::create('beneficiaries', function (Blueprint $table) {
            $table->id();
            $table->uuid('code');
            $table->text('nick_name');
            $table->timestamp('interviewed_at')->nullable();
            $table->string('profile_photo', 255)->nullable();
            $table->text('first_name');
            $table->text('last_name');
            $table->text('middle_name')->nullable();
            $table->text('birth_date');
            $table->text('birth_place')->nullable();
            $table->text('religion')->nullable();
            $table->text('educational_attainment')->nullable();
            $table->text('last_school_year_attended')->nullable();
            $table->text('contact_no')->nullable();
            $table->text('prepared_by')->nullable();
            $table->text('noted_by')->nullable();
            $table->text('category')->nullable();
            $table->text('label')->nullable();

            $table->foreignId('charitable_organization_id')->references('id')->on('charitable_organizations')->constrained();
            $table->foreignId('present_address_id')->references('id')->on('addresses')->constrained();
            $table->foreignId('permanent_address_id')->references('id')->on('addresses')->constrained();
            $table->foreignId('provincial_address_id')->references('id')->on('addresses')->constrained();
            $table->foreignId('last_modified_by_id')->references('id')->on('users')->constrained();
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
        Schema::dropIfExists('beneficiaries');
    }
};
