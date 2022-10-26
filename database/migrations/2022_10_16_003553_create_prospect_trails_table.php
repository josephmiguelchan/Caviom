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
        Schema::create('prospect_trails', function (Blueprint $table) {
            $table->id();
            $table->foreignId('charitable_organization_id')->references('id')->on('charitable_organizations')->constrained();
            $table->float('amount', 8, 2);
            $table->string('mode_of_payment', 128);
            $table->string('action', 255);
            $table->float('running_balance', 10, 2);
            $table->timestamp('paid_at');
            $table->timestamp('created_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('prospect_trails');
    }
};
