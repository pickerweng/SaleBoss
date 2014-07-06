<?php

namespace SaleBoss\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Value extends Eloquent {

	protected $table = 'values';

	public $timestamps = false;

	/**
	 * One to many relationship between values and attributes
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function attribute()
	{
		return $this->belongsTo('SaleBoss\Models\Attribute', 'attribute_id');
	}

	/**
	 * One to many relationship with Values and Entities
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function entity()
	{
		return $this->belongsTo('SaleBoss\Models\Entity','entity_id');
	}

	/**
	 * Join attriute title
	 *
	 * @param $query
	 * @return mixed
	 */
	public function scopeAddAttributes($query)
	{
		return $query->join('attributes','attributes.id','=','values.attribute_id');
	}

} 