<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFinalFieldsToUserTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('users',function($table){
			$table->integer('creator_id')->unsigned()->nullable()->after('id');
			$table->string('job')->after('email')->nullable();
			$table->string('business')->after('email')->nullable();
			$table->string('tell',20)->after('email')->nullable();
			$table->string('national_code',20)->after('email');
			$table->text('address')->nullable()->after('email');
			$table->string('connection_way')->nullable()->after('email');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('users',function($table){
			$table->dropColumn('creator_id');
			$table->dropColumn('job');
			$table->dropColumn('business');
			$table->dropColumn('tell');
			$table->dropColumn('national_code');
			$table->dropColumn('address');
		});
	}

}
