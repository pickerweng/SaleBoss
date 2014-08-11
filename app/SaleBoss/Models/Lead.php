<?php namespace SaleBoss\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Lead extends Eloquent {

    protected $table = 'leads';
    protected $guarded = [];

    use DateTrait;
    use SoftDeletingTrait;

    /**
     * The Lead is locked by
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function locker()
    {
        return $this->belongsTo('SaleBoss\Models\User','locker_id');
    }

    /**
     * The creator of the lead
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function creator()
    {
        return $this->belongsTo('SaleBoss\Models\User','creator_id');
    }

    public function tags()
    {
		return $this->morphToMany(
			'SaleBoss\Models\Tag',
			'taggable',
			'taggables',
			'tag_id',
			'taggable_id'
		);
    }

	public function phones()
	{
		return $this->morphsToMany(
			'SaleBoss\Models\Phone',
			'phonable',
			'phonables',
			'phone_id',
			'phonable_id'
		);
	}

} 