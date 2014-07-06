<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotificationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('notifications',function($table){
			$table->increments('id');
			$table->integer('user_id')->unsigned();
			$table->text('message');
			$table->boolean('closed')->default(0);

			// $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('notifications',function($table){
			// $table->dropForeign('notifications_user_id_foreign');
		});
	}

}
