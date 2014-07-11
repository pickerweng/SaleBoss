<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttributesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('attributes',function($table){
			$table->increments('id');
			$table->integer('entity_type_id')->unsigned();
			$table->string('form_type')->nullable();
			$table->string('machine_name');
			$table->string('display_name');
			$table->softDeletes();

			$table->unique(array('entity_type_id','machine_name'));
			// $table->foreign('entity_type_id')->references('id')->on('entity_types')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('attributes',function($table){
			$table->dropForeign('attributes_entity_type_id_foreign');
		});
	}
}
