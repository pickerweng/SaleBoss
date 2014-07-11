<?php

namespace SaleBoss\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Order extends  Eloquent{

	protected  $table = 'orders';

	public $timestamps = false;
	/**
	 * One to one relationship between entity and opilo orders
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function entity()
	{
		return $this->belongsTo('SaleBoss\Models\Entity');
	}

	public function orderLogs()
	{
		//
	}
} 