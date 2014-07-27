<?php

namespace SaleBoss\Repositories\Eloquent;

use SaleBoss\Models\Order;
use SaleBoss\Models\State;
use SaleBoss\Models\User;
use SaleBoss\Repositories\Exceptions\NotFoundException;
use SaleBoss\Repositories\OrderRepositoryInterface;

class OrderRepository extends AbstractRepository implements OrderRepositoryInterface {

	protected $model;

	/**
	 * @param Order $order
	 * @param State $state
	 */
	public function __construct(
		Order $order,
		State $state
	){
		$this->model = $order;
		$this->state = $state;
	}

    public function getGeneratedOrders($user = null, $int)
    {
        if (is_null($user))
        {
            return $this->model->newInstance()->paginate($int);
        }
        return $user->orders()->with('customer')->paginate($int);
    }

    /**
     * @param User $user
     * @param      $perms
     * @param      $int
     *
     * @return mixed
     */
    public function getAvailableOrders(User $user = null,$perms, $int = 5)
    {
        $query = $this->model->newInstance();
        if (empty($perms)) $perms=['No state array'];
        if ( ! is_null($user))
        {
            $query = $query->where('creator_id',$user->id);
        }
        $orders = $query->with('customer')->whereHas('state',function($q)use($perms){
            $q->whereIn('id',(array) $perms);
        });
        return $orders->paginate($int);
    }

    public function countableMonthChart()
    {
        return $this->model->newInstance()->chartedOnDateByMonth()->get();
    }

	/**
	 * @param state $orderId
	 * @param $int state
	 * @param $approved
	 * @param $description
	 * @throws \SaleBoss\Repositories\Exceptions\NotFoundException
	 * @internal param $get
	 * @internal param $get1
	 * @return mixed
	 */
	public function stateUpdate($orderId,$int, $approved, $description)
	{

	}
}