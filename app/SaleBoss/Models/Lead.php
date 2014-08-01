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

    /**
     * Check input for search
     *
     * @param $q
     */
    public function scopeMakeSearchable($q)
    {

    }

} 