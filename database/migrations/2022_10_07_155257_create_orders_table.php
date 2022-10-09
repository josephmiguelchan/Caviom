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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->uuid('code');
            $table->foreignId('charitable_organization_id')->constrained();
            $table->unsignedBigInteger('reference_no');
            $table->string('proof_of_payment',128);
            $table->char('mode_of_payment',128);
            $table->float('total', 5, 2)->nullable();
            $table->char('status',128)->default('Pending');
            $table->string('remarks_subject',128)->nullable();
            $table->string('remarks_message',512)->nullable();
            $table->timestamp('status_updated_at')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('paid_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
