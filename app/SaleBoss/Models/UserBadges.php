<?php namespace SaleBoss\Models;

use Illuminate\Database\Eloquent\Model;

class UserBadge extends Model {

	protected $table = 'user_badges';

	/**
	 * One to many relationship betweeen user and user badges
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function user()
	{
		return $this->belongsTo('SaleBoss\Models\User','user_id');
	}
} 