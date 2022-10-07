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
            $table->text('address_line_one');
            $table->text('address_line_two')->nullable();
            $table->text('region');
            $table->text('province');
            $table->text('city')->nullable();
            $table->text('barangay')->nullable();
            $table->text('postal_code');
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
