<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEntityTypesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('entity_types',function($table){
			$table->increments('id');
			$table->integer('user_id')->nullable()->unsigned();
			$table->string('machine_name')->unique();
			$table->string('display_name');
			$table->softDeletes();

			// $table->foreign('user_id')->references('id')->on('users')->onDelete('SET NULL');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('entity_types',function($table){
			// $table->dropForeign('entity_types_user_id_foreign');
		});
	}

}
