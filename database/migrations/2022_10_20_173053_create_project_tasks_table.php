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
        Schema::create('project_tasks', function (Blueprint $table) {
            $table->id();
            $table->uuid('code');
            $table->foreignId('project_id')->references('id')->on('projects')->constrained()->onDelete('cascade');
            $table->foreignId('assigned_by')->references('id')->on('users')->constrained();
            $table->foreignId('assigned_to')->references('id')->on('users')->constrained();
            $table->string('title', 100);
            $table->string('note', 280)->nullable();
            $table->char('status', 20)->default('Pending');
            $table->timestamp('deadline');
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
        Schema::dropIfExists('project_tasks');
    }
};
