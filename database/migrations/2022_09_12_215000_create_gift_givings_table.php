<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */


    public function up()
    {
        Schema::create('gift_givings', function (Blueprint $table) {
            $table->id();
            $table->uuid('code');
            $table->foreignId('charitable_organization_id')->nullable()->constrained();
            $table->string('name', 50);
            $table->string('objective', 512);
            $table->timestamp('start_at')->nullable();
            $table->string('venue', 255);
            $table->string('sponsor', 255)->nullable();
            $table->foreignId('last_downloaded_by')->nullable()->references('id')->on('users')->constrained();
            $table->unsignedInteger('batch_no')->default('0');
            $table->float('amount_per_pack', 6, 2);
            $table->unsignedInteger('no_of_packs')->nullable();
            $table->float('total_budget', 12, 2);
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
        Schema::dropIfExists('gift_givings');
    }
};
