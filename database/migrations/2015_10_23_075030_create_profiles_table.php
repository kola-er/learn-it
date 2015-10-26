<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Schema::create('profiles', function (Blueprint $table) {
			$table->increments('id')->unique();
			$table->integer('user_id')->unique()->unsigned();
			$table->string('first_name')->nullable();
			$table->string('last_name')->nullable();
			$table->string('avatar')->nullable();
			$table->softDeletes();
			$table->timestamps();

			$table->foreign('user_id')
				->references('id')
				->on('users')
				->onUpdate('cascade')
				->onDelete('cascade');
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
		Schema::drop('profiles');
    }
}
