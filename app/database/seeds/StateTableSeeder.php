<?php

class StateTableSeeder extends Seeder {

	/**
	 * Run the seeder
	 */
	public function run()
	{
		DB::table('states')->insert([
			['title' => 'صف فروشنده', 'priority' => 0],
			['title' => 'صف حسابداری', 'priority' => 1],
			['title' => 'صف پشتیبانی', 'priority' => 2],
			['title' => 'پایان' , 'priority' => 3]
		]);

		$this->command->info("'states' table seeded with 4 rows check that!!!");
	}
} 