<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLeadIdToUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('users',function($t){
            $t->integer('lead_id')->unsigned()->nullable()->after('id');

            $t->foreign('lead_id')->references('id')->on('leads')->onDelete('set null');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('users',function($t){
            $t->dropForeign('users_lead_id_foreign');
            $t->dropColumn('lead_id');
        });
	}

}
