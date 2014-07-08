<?php

namespace SaleBoss\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Menu  extends Eloquent {
	protected $table = 'menus';
	public $timestamps = false;

	/**
	 * One to many relationship with MenuType and Menu
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function menuType()
	{
		return $this->belongsTo('MenuType','menu_type_id');
	}
} 