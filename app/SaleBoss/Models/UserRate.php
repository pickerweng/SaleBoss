<?php namespace SaleBoss\Models;

use Illuminate\Database\Eloquent\Model;

class UserRate extends Model {

	protected $table = 'user_rates';

	/**
	 * One to many relationship between user and his rates in different time periods
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function user()
	{
		return $this->belongsTo('SaleBoss\Models\User','user_id');
	}


} 