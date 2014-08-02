<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('orders',function($table){
			$table->increments('id');
			$table->integer('customer_id')->unsigned();
			$table->integer('creator_id')->unsigned();
			$table->string('panel_type')->nullable();
			$table->string('private_number')->nullable();
			$table->string('sms_price');
			$table->text('sms_text');
			$table->integer('sms_quantity');
			$table->text('sms_description')->nullable();
			$table->string('payment_type');
			$table->string('cart_number')->nullable();
			$table->integer('state_id')->unsigned();
			$table->integer('final_price');
			$table->integer('line_price');
			$table->integer('other');
			$table->decimal('vat');
			$table->text('description')->nullable();
			$table->text('data')->nullable();
			$table->date('completed_at');
			$table->boolean('completed')->default(0);
			$table->timestamps();
			$table->softDeletes();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('orders');
	}

}
