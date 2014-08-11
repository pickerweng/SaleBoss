<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePhonableTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('phonables',function(Blueprint $table){
			$table->increments('id');
			$table->integer('phone_id')->unsigned()->index();
			$table->foreign('phone_id')->references('id')->on('phones')->onDelete('cascade');
			$table->string('phonable_type')->index();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('phonables');
	}

}
