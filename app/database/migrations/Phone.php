<?php  namespace SaleBoss\Models; 

class Phone extends \Eloquent {

	protected $table = 'phones';

	public $timestmps = false;

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
			'phone_id',
			'phonable_id'
		);
	}
} 