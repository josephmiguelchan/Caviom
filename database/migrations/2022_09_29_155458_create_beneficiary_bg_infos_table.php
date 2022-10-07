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
        Schema::create('beneficiary_bg_infos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('beneficiary_id')->references('id')->on('beneficiaries')->constrained();
            $table->text('problem_presented');
            $table->text('about_client');
            $table->text('about_family');
            $table->text('about_community');
            $table->text('assessment');

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
        Schema::dropIfExists('beneficiary_bg_infos');
    }
};
