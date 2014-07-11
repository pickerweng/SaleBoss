<?php

class MenuTableSeeder extends Seeder {

	/**
	 * Run the Seeding
	 *
	 * @return void
	 */
	public function run()
	{
		$menus = [
            [
                'title' =>  'Sub1',
                'parent_id' => null,
                'menu_type_id'  => 1
            ],
            [
                'title' =>  'Sub2',
                'parent_id' =>  null,
                'menu_type_id'  => 1
            ],
            [
                'title' =>  'Sub1.1',
                'parent_id' =>  1,
                'menu_type_id'  => 1
            ],
            [
                'title' =>  'Sub2.1',
                'parent_id' =>  2,
                'menu_type_id'  => 1
            ],
            [
                'title' =>  'Sub1.1.1',
                'parent_id' =>  3,
                'menu_type_id'  => 1
            ],
            [
                'title' =>  'Sub1.1.2',
                'parent_id' =>  3,
                'menu_type_id'  => 1
            ],
            [
                'title' =>  'Sub2.1.1',
                'parent_id' => 4,
                'menu_type_id'  => 1
            ],
            [
                'title' =>  'Sub1.1.1.1',
                'parent_id' => 3,
                'menu_type_id'  => 1
            ]
		];
		DB::table('menus')->insert($menus);
	}
}