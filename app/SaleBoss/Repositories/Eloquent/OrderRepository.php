<?php

namespace SaleBoss\Repositories\Eloquent;

use SaleBoss\Models\Entity;
use SaleBoss\Models\Order;
use SaleBoss\Models\User;
use SaleBoss\Repositories\OrderRepositoryInterface;

class OrderRepository extends AbstractRepository implements OrderRepositoryInterface {

	protected $model;

	/**
	 * @param Order $order
	 */
	public function __construct(
		Order $order
	){
		$this->model = $order;
	}

    public function getGeneratedOrders($user = null, $int)
    {
        if (is_null($user))
        {
            return $this->model->newInstance()->paginate($int);
        }
        return $user->orders()->paginate($int);
    }

    public function getAvailableOrders($perms, $int)
    {
        return $this->model->newInstance()->whereHas('state',function($query) use($perms){
            $query->where('priority','in',$perms);
        })->get();
    }

    public function countableMonthChart()
    {
        return $this->model->newInstance()->chartedOnDateByMonth()->get();
    }
}