<?php  namespace SaleBoss\Models; 

class Phone extends \Eloquent {

	protected $table = 'phones';

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
			'phonable',
			'phonables',
			'phonable_id',
			'phone_id'
		);
	}
} 