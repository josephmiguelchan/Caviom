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
        Schema::create('gift_giving_beneficiaries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('gift_giving_id')->constrained()->onDelete('cascade');
            $table->unsignedInteger('ticket_no');
            $table->text('name');
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
        Schema::dropIfExists('gift_giving_beneficiaries');
    }
};
