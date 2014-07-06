<?php

namespace SaleBoss\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class EntityType extends Eloquent{

	use SoftDeletingTrait;

	protected $table = 'entity_types';

	public $timestamps = false;

	/**
	 * Relation between Entity and Entity Types (1:n)
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function entities()
	{
		return $this->hasMany('SaleBoss\Models\Entity', 'entity_type_id', 'id');
	}

	/**
	 * One to many relationship between EntityType and Attribute
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function attributes()
	{
		return $this->hasMany('SaleBoss\Models\Attribute','entity_type_id','id');
	}


} 