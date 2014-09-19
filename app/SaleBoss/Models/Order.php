<?php

namespace SaleBoss\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Miladr\Jalali\jDate;

class Order extends  BaseEloquent{

	protected  $table = 'orders';
    protected $guarded = [];

    use ChartTrait;

	/**
	 * One to many relationship between order and it's logs
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function orderLogs()
	{
		return $this->hasMany('SaleBoss\Models\OrderLog','order_id');
	}

	/**
	 * Relationship between the state and order
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function state()
	{
		return $this->belongsTo('SaleBoss\Models\State','state_id');
	}

	/**
	 * Relation between order and customer
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function customer()
	{
		return $this->belongsTo('SaleBoss\Models\User','customer_id');
	}

	/**
	 * Relation between user and it's creator
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function creator()
	{
		return $this->belongsTo('SaleBoss\Models\User','creator_id');
	}

    public function diff()
    {
        return jDate::forge($this->created_at)->ago();
    }

    public function scopeMakeSearchable($q)
    {
        $input = Input::all();
        if (! empty($input['id']))
        {
            $q = $q->where('id','=',$input['id']);
        }
        if(! empty($input['state_id']))
        {
            $q = $q->where('state_id','=',$input['state_id']);
        }
        if(! empty($input['customer']))
        {
            $q = $q->whereHas('customer',function($q) use ($input){
                $q->where(DB::raw("CONCAT(first_name,' ',last_name)"),'LIKE',"%{$input['customer']}%");
            });
        }
        if(! empty($input['creator']))
        {
            $q = $q->whereHas('creator',function($q) use ($input){
               $q->where(DB::raw("CONCAT(first_name,' ',last_name)"),'LIKE',"%{$input['creator']}%");
            });
        }
        if(!empty($input['creator_id']))
        {
            $q = $q->where('creator_id','=',$input['creator_id']);
        }
        if(!empty($input['customer_id']))
        {
            $q = $q->where('customer_id','=',$input['customer_id']);
        }
        if(isset($input['panel_type']))
        {
	        if ($input['panel_type'] !== '')
	        {
		        $q = $q->where('panel_type','=',$input['panel_type']);
	        }
        }
        if(!empty($input['cart_number']))
        {
            $q = $q->where('cart_number','=',$input['cart_number']);
        }
        if(!empty($input['private_number']))
        {
            $q = $q->where('private_number','LIKE',$input['private_number']);
        }
        if(!empty($input['description']))
        {
            $q = $q->where('description','LIKE',$input['description']);
        }
        if(!empty($input['accounter_approved']))
        {
            $q = $q->where('accounter_approved',true);
        }
        if(isset($input['completed']) && !is_null($input['completed']))
        {
            $q = $q->where('completed',$input['completed']);
        }
        if(!empty($input['suspended']))
        {
            $q = $q->where('suspended', true);
        }
        return $q;
    }

    public function scopeMakeSortable($q)
    {
        $sortBy = Input::get('sort_by');
        $asc = Input::get('asc');
        if (in_array($sortBy,['created_at','updated_at','id']))
        {
            $q->orderBy($sortBy,empty($asc) ? "DESC" : "ASC");
        }else
        {
            $q->orderBy('created_at','DESC');
        }
    }
}
