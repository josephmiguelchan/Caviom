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
        Schema::create('featured_project_photos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('featured_project_id')->constrained();
            $table->string('featured_photo_1',128)->nullable();
            $table->string('featured_photo_2',128)->nullable();
            $table->string('featured_photo_3',128)->nullable();
            $table->string('featured_photo_4',128)->nullable();
            $table->string('featured_photo_5',128)->nullable();
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
        Schema::dropIfExists('featured_project_photos');
    }
};
