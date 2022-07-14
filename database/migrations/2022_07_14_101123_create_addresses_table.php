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
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->char('type', 20);
            $table->string('address_line_one', 255);
            $table->string('address_line_two', 255)->nullable();
            $table->string('province', 255);
            $table->char('postal_code', 20);
            $table->string('barangay', 255);
            $table->timestamps();
        });

        // Schema::table('user_infos', function (Blueprint $table) {
        //     $table->foreignId('address_id')->constrained(); // This should've been on the addresses table
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('addresses');

        // Schema::table('user_infos', function (Blueprint $table) {
        //     $table->dropColumn('address_id');
        // });
    }
};
