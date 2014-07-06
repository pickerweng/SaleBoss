<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateValuesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('values',function($table){
			$table->increments('id');
			$table->integer('entity_id')->unsigned();
			$table->integer('attribute_id')->unsigned();
			$table->string('value')->index();

			$table->unique(array('entity_id','attribute_id','value'));

//			$table->foreign('entity_id')
//				  ->references('id')
//				  ->on('entities')
//				  ->onDelete('cascade');
//
//			$table->foreign('attribute_id')
//				  ->references('id')
//				  ->on('attributes')
//				  ->onDelte('cascade');

		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('values',function($table){
//			$table->dropForeign('values_attribute_id_foreign');
//			$table->dropForeign('values_entity_id_foreign');
		});
	}

}
