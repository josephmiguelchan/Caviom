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
        Schema::create('beneficiary_family_infos', function (Blueprint $table) {
            $table->id();
            $table->text('first_name');
            $table->text('last_name');
            $table->text('middle_name')->nullable();
            $table->text('birth_date');
            $table->text('relationship');
            $table->text('civil_status')->nullable();
            $table->text('education')->nullable();
            $table->text('occupation')->nullable();
            $table->text('income')->nullable();
            $table->text('where_abouts')->nullable();

            $table->foreignId('beneficiary_id')->references('id')->on('beneficiaries')->constrained();
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
        Schema::dropIfExists('beneficiary_family_infos');
    }
};
