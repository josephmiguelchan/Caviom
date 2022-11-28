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
        Schema::create('prospects', function (Blueprint $table) {
            $table->id();
            $table->uuid('code');
            $table->foreignId('charitable_organization_id')->references('id')->on('charitable_organizations')->constrained();
            $table->string('proof_of_payment_photo', 255)->nullable();
            $table->float('amount', 8, 2);
            $table->float('total', 8, 2)->nullable();
            $table->string('mode_of_donation', 255);
            $table->string('message', 512)->nullable();
            $table->text('first_name');
            $table->text('last_name');
            $table->text('middle_name')->nullable();
            $table->string('remarks', 255)->nullable();
            $table->string('email_address', 128)->nullable();
            $table->timestamp('paid_at')->nullable();
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
        Schema::dropIfExists('prospects');
    }
};
