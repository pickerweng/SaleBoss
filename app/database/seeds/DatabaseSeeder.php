<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		//$this->call('UserTableSeeder');
		//$this->call('StateTableSeeder');
		// $this->call('NotificationTableSeeder');
		//$this->call('EavModelSeeder');
		//$this->call('UserTableSeeder');
		//$this->call('MenuTypeTableSeeder');
		//$this->call('MenuTableSeeder');
		$this->call('OpiloOrdersInit');
        //$this->call('MenuTableSeeder');
	}

}
