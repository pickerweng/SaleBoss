<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEntitiesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('entities',function($table){
			$table->increments('id');
			$table->integer('entity_type_id')->nullable()->unsigned();
			$table->string('title');
			$table->text('description')->nullable();
			$table->text('data')->nullable();
			$table->softDeletes();
			$table->timestamps();

			// $table->foreign('entity_type_id')->references('id')->on('entity_types')->onDelete('SET NULL');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('entities',function($table){
			$table->dropForeign('entities_entity_type_id_foreign');
		});
	}

}
