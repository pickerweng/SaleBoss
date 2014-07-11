<?php

class NotificationTableSeeder extends Seeder {
	/**
	 * Run the seeder
	 *
	 * @throws Exception
	 * @return void
	 */
	public function run()
	{
		$user = User::find(1);

		if ( is_null($user) )
			throw new Exception("Notifications needs a user ! and it it now null");

		DB::table('notifications')->insert([
			['user_id' => $user->id, 'message' => "Initial user 1 message"]
		]);

	}
} 