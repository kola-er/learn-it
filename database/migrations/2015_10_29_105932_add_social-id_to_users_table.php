<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSocialIdToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->integer('fb_id')->unique()->unsigned()->nullable();
			$table->integer('tw_id')->unique()->unsigned()->nullable();
			$table->integer('gh_id')->unique()->unsigned()->nullable();
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
            $table->dropColumn('fb_id');
			$table->dropColumn('tw_id');
			$table->dropColumn('gh_id');
        });
    }
}
