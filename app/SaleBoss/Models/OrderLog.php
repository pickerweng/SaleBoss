<?php namespace SaleBoss\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class OrderLog  extends Eloquent{

	protected $table = 'order_logs';
	protected $guarded  = [];

	/**
	 * One to many relationship ship between orders and it's logs
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function order()
	{
		return $this->belongsTo('SaleBoss\Models\Order','order_id');
	}

	/**
	 * One to many relationship between changer user and user table
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function changer()
	{
		return $this->belongsTo('SaleBoss\Models\User','changer_id');
	}

	/**
	 * One to many relationship beween this log and it's previous change
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function previousChanger()
	{
		return $this->belongsTo('SaleBoss\Models\User','previous_changer_id');
	}
} 