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
        Schema::create('profile_secondary_infos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('charitable_organization_id')->references('id')->on('charitable_organizations')->constrained();
            $table->text('our_story');
            $table->string('our_story_photo', 255)->nullable();
            $table->text('our_goal');
            $table->string('our_goal_photo', 255)->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profile_secondary_infos');
    }
};
