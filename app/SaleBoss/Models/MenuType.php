<?php namespace SaleBoss\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class MenuType extends Eloquent {

	public $timestamps = false;
	protected $table = 'menu_types';

	/**
	 * One to many relationship between MenuType and Menu
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function menus()
	{
		return $this->hasMany('SaleBoss\Models\Menu','menu_type_id');
	}
}