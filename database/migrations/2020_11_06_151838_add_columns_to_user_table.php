<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('quote')->nullable();
            $table->date('birth_date')->nullable();
            $table->unsignedInteger('profession_id')->nullable();
            $table->unsignedInteger('country_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('quote');
            $table->dropColumn('birth_date');
            $table->dropColumn('profession_id');
            $table->dropColumn('country_id');
        });
    }
}
