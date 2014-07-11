<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenusTabke extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('menus',function($table){
			$table->increments('id');
			$table->integer('menu_type_id')->unsigend();
			$table->string('permission_name');
			$table->string('title');
			$table->text('description');
			$table->string('uri',600);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('menus');
	}

}
