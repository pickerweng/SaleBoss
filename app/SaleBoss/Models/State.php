<?php namespace SaleBoss\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class State extends Eloquent {

	public $table = 'states';
	public $timestamps = false;

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function orders()
	{
		return $this->belongsToMany('SaleBoss\Models\Order','state_id');
	}
}