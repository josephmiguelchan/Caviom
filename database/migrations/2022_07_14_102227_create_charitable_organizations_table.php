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
        Schema::create('charitable_organizations', function (Blueprint $table) {
            $table->id();
            $table->uuid('code');
            $table->string('name', 128);
            $table->unsignedInteger('star_tokens')->default(4500);
            $table->unsignedInteger('featured_project_credits')->default(0);
            $table->char('subscription', 20)->default('Free');
            $table->timestamp('subscribed_at')->nullable();
            $table->char('visibility_status', 20)->default('Hidden');
            $table->char('verification_status', 20)->default('Unverified');

            // These should be on the child tables
            /*
                $table->foreignId('profile_primary_info_id')->constrained()->nullable()->onDelete('cascade');
                $table->foreignId('profile_secondary_info_id')->constrained()->nullable()->onDelete('cascade');
                $table->foreignId('profile_cover_id')->constrained()->nullable()->onDelete('cascade');
                $table->foreignId('profile_requirement_id')->constrained()->nullable()->onDelete('cascade');
            */

            $table->string('remarks_subject', 128)->nullable();
            $table->string('remarks_message', 512)->nullable();
            $table->timestamp('status_updated_at')->nullable();
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
        Schema::dropIfExists('charitable_organizations');
    }
};
