<?php

namespace SaleBoss\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Attribute extends Eloquent {

	protected $table = 'attributes';

	public $timestamps = false;

	/**
	 * One to Many relationship between EntityType and Attributes
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function entity_type()
	{
		return $this->belongsTo('SaleBoss\Models\EntityType','entity_type_id');
	}
} 