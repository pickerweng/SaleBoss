<?php

class UserTableSeeder extends Seeder
{

	/**
	 * Run the Seeder
	 *
	 * @return void
	 */
	public function run()
	{
		Sentry::register([
			'email'     =>  'pcfeeler@gmail.com',
			'password'  =>  '123456',
            'activated' =>  true
		]);
	}
}