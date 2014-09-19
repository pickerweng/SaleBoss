<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaggableTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('taggables',function($t){
			$t->increments('id');

			$t->integer('tag_id')->unsigned();
			$t->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade');

			$t->integer('taggable_id')->unsigned()->index();
			$t->string('taggable_type')->index();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('taggables');
	}

}
