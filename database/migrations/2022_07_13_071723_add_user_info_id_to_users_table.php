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
        // Schema::table('users', function (Blueprint $table) {
        //     $table->integer('user_info_id')->unsigned()->after('id');
        //     $table->foreignId('user_info_id')->references('id')->on('users')->onDelete('cascade');
        //     $table->dropColumn('name');
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::table('users', function (Blueprint $table) {
        //     Schema::table('users', function (Blueprint $table) {
        //         $table->dropForeign('users_user_info_id_foreign');
        //         $table->dropColumn('user_info_id');
        //         // $table->string('name')->after('id');
        //     });
        // });
    }
};
