<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateAttributesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('attributes',function($table){
			$table->boolean('exclude')->default(0);
			$table->text('options')->nullable()->after('display_name');
			$table->string('default_value')->nullable();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('attributes',function($table){
			$table->dropColumn('exclude');
			$table->dropColumn('options');
			$table->dropColumn('default_value');
		});
	}

}
