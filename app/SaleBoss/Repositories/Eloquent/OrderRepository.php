<?php

namespace SaleBoss\Repositories\Eloquent;

use Illuminate\Database\QueryException;
use SaleBoss\Models\Order;
use SaleBoss\Models\User;
use SaleBoss\Repositories\Exceptions\InvalidArgumentException;
use SaleBoss\Repositories\OrderRepositoryInterface;
use SaleBoss\Repositories\state;

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

	/**
	 * Get generated orders of a user or all
	 *
	 * @param null $user
	 * @param $int
	 * @return mixed
	 */
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

	/**
	 * Count orders by month
	 *
	 * @return Collection
	 */
	public function countableMonthChart()
    {
        return $this->model->newInstance()->chartedOnDateByMonth()->get();
    }


	/**
	 * Update order
	 *
	 * @param Order $order
	 * @param array $data
	 * @throws \SaleBoss\Repositories\Exceptions\InvalidArgumentException
	 * @return mixed
	 */
	public function update(Order $order,array $data = [])
	{
		try {
			$order->update($data);
			return $order;
		}catch (QueryException $e){
			throw new InvalidArgumentException($e->getMessage());
		}
	}

    public function getSearchableOrders ($int)
    {
        return $this->model->with('state','customer')->makeSearchable()->makeSortable()->paginate($int);
    }

    public function getSearchableCreatorOrders(User $creator,$int)
    {
        return $creator->orders()->with('state','customer')->makeSearchable()->makeSortable()->paginate($int);
    }
}