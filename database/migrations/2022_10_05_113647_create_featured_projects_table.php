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
        Schema::create('featured_projects', function (Blueprint $table) {
            $table->id();
            $table->uuid('code');
            $table->foreignId('charitable_organization_id')->constrained();
            $table->string('name', 50);
            $table->string('cover_photo', 255)->nullable();
            $table->date('started_on');
            $table->unsignedSmallInteger('total_beneficiaries')->nullable();
            $table->string('sponsors', 255)->nullable();
            $table->string('venue', 255)->nullable();
            $table->text('objectives');
            $table->text('message')->nullable();
            $table->char('visibility_status', 20)->default('Hidden');
            $table->char('approval_status', 20)->default('Pending');
            $table->char('paid_using', 20); // New
            $table->timestamp('status_updated_at')->nullable();
            $table->string('remarks_subject', 128)->nullable();
            $table->string('remarks_message', 512)->nullable();
            $table->foreignId('reviewed_by')->nullable()->references('id')->on('users')->constrained();

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
        Schema::dropIfExists('featured_projects');
    }
};
