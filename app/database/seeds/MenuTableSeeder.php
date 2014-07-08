<?php

use SaleBoss\Models\MenuType;

class MenuTableSeeder extends Seeder {

	/**
	 * Run the Seeding
	 *
	 * @return void
	 */
	public function run()
	{
		$type = MenuType::find(1);
		$menus = [
			[
				'uri'   =>  'http:://google.com',
				'title' =>  'مشاهده دیتا',
				'permission_name'   => 'view_menu_link',
				'menu_type_id'  => $type->id
			]
		];
		DB::table('menus')->insert($menus);
	}
} 