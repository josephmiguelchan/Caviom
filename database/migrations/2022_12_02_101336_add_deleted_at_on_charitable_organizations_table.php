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
        Schema::table('charitable_organizations', function (Blueprint $table) {
            $table->softDeletes($column = 'deleted_at', $precision = 0)->after('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('charitable_organizations', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
};
