<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Schema::create('videos', function (Blueprint $table) {
			$table->increments('id')->unique();
			$table->integer('user_id')->unsigned();
			$table->integer('category_id')->unsigned();
			$table->string('title');
			$table->string('description')->nullable();
			$table->string('url');
			$table->softDeletes();
			$table->timestamps();

			$table->foreign('user_id')
				->references('id')
				->on('users')
				->onUpdate('cascade')
				->onDelete('cascade');

			$table->foreign('category_id')
				->references('id')
				->on('categories')
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
		Schema::drop('videos');
	}
}
