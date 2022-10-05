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
            // $table->foreignId('last_downloaded_by')->nullable()->constrained();
            
            $table->bigInteger('last_downloaded_by')->unsigned()->nullable();
            $table->foreign('last_downloaded_by')->references('id')->on('users');
            
            $table->unsignedInteger('batch_no')->default('0');
            $table->float('amount_per_pack', 6, 2);
            $table->unsignedInteger('no_of_packs')->nullable();
            $table->float('total_budget', 8, 2); // might need to be updated for more value added
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





