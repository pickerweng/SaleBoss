<?php

class MenuTypeTableSeeder extends Seeder {
	/**
	 * Run the seeding
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('menu_types')->insert([
			['machine_name' => 'sidebar','display_name' => 'سایدبار']
		]);
	}

} 