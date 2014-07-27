<?php

namespace SaleBoss\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;
use Miladr\Jalali\jDate;

class Order extends  Eloquent{

	protected  $table = 'orders';
    protected $guarded = [];

    use ChartTrait;

	/**
	 * One to many relationship between order and it's logs
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function orderLogs()
	{
		return $this->hasMany('SaleBoss\Models\OrderLog','order_id');
	}

	/**
	 * Relationship between the state and order
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function state()
	{
		return $this->belongsTo('SaleBoss\Models\State','state_id');
	}

	/**
	 * Relation between order and customer
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function customer()
	{
		return $this->belongsTo('SaleBoss\Models\User','customer_id');
	}

	/**
	 * Relation between user and it's creator
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function creator()
	{
		return $this->belongsTo('SaleBoss\Models\User','creator_id');
	}

    public function diff()
    {
        return jDate::forge($this->created_at)->ago();
    }
}