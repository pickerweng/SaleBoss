<?php namespace SaleBoss\Models;

class Lead extends BaseEloquent {

    protected $table = 'leads';
    protected $guarded = [];

    use DateTrait;

    protected $dates = ['created_at','updated_at','remind_at'];

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
			'taggable_id',
			'tag_id'
		);
    }

	public function phones()
	{
		return $this->morphToMany(
			'SaleBoss\Models\Phone',
			'phonable',
			'phonables',
			'phonable_id',
			'phone_id'
		);
	}

} 
