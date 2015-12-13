<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeIntegerLengthOfSocialIdFieldsInUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
			$table->bigInteger('fb_id')->change();
			$table->bigInteger('tw_id')->change();
			$table->bigInteger('gh_id')->change();
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
