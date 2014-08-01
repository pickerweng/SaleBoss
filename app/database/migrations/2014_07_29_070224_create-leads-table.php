<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeadsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('leads',function($t){
            $t->increments('id');
            $t->integer('creator_id')->unsigned()->nullable();
            $t->integer('locker_id')->unsigned()->nullable();
            $t->boolean('shared')->default(1);
            $t->integer('priority')->default(0);
            $t->integer('status')->default(0);
            $t->string('phone_number');
            $t->text('description');
            $t->timestamp('remind_at')->nullable();
            $t->timestamp('locked_at')->nullable();
            $t->timestamps();
            $t->softDeletes();

            $t->foreign('creator_id')
              ->references('id')
              ->on('users')
              ->onDelete('set null');

            $t->foreign('locker_id')
              ->references('id')
              ->on('users')
              ->onDelete('set null');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('leads',function($t){
            $t->dropForeign('leads_creator_id_foreign');
            $t->dropForeign('leads_locker_id_foreign');
        });
	}

}
