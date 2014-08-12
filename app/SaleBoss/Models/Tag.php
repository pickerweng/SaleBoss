<?php namespace SaleBoss\Models;


use Illuminate\Database\Eloquent\Model as Eloquent;

class Tag extends Eloquent {

	protected $table = 'tags';

	protected $guarded = ['id'];

	public $timestamps = false;

	/**
	 * Polymorphic relation of laravel
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\MorphTo
	 */
	public function lead ()
	{
		return $this->morphedByMany(
			'SaleBoss\Models\Lead',
			'taggable',
			'taggables',
			'taggable_id',
			'tag_id'
		);
	}

} 