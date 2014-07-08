<?php

namespace SaleBoss\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class MenuType extends Eloquent {

	public $timestamps = false;
	protected $table = 'menu_types';

	/**
	 * One to many realtionship between MenuType and Menu
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function menus()
	{
		return $this->hasMany('Menu','menu_type_id');
	}
} 