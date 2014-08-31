<?php

namespace SaleBoss\Repositories\Eloquent;

use Illuminate\Database\QueryException;
use SaleBoss\Models\Lead;
use SaleBoss\Models\Order;
use SaleBoss\Models\User;
use SaleBoss\Repositories\Exceptions\InvalidArgumentException;
use SaleBoss\Repositories\OrderRepositoryInterface;
use SaleBoss\Repositories\state;
use DB;

class OrderRepository extends AbstractRepository implements OrderRepositoryInterface {

	protected $model;
    protected $leadModel;
    protected $userModel;

    /**
     * @param Order                                                      $order
     * @param \SaleBoss\Models\User                                      $userModel
     * @param \SaleBoss\Models\Lead|\SaleBoss\Repositories\Eloquent\Lead $leadModel
     */
	public function __construct(
		Order $order,
        User $userModel,
        Lead $leadModel
	){
		$this->model = $order;
        $this->userModel = $userModel;
        $this->leadModel = $leadModel;
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
        return $this->model->with('state','customer','creator')
	                        ->makeSearchable()
	                        ->makeSortable()
	                        ->paginate($int);
    }

    public function getSearchableCreatorOrders(User $creator,$int)
    {
        return $creator->orders()->with('state','customer','creator')->makeSearchable()->makeSortable()->paginate($int);
    }

    public function sumPanelPrice($start = null, $end = null, $query = [])
    {
        $q = $this->addSimpleWheres($this->model->newInstance()->getQuery(), $query);
        $q = $this->addStartRange($q, $start);
        $q = $this->addEndRange($q, $end);
        return $q->sum('panel_price');
    }

    public function getScoreList($start = null, $end = null, array $queries = [])
    {
        /*$q = $this->model
                  ->newInstance()->with('creator')->groupBy('creator_id')
                  ->where('completed',true)
                  ->where('panel_type',0)
                  ->orderBy('totalCount','DESC');

        if(!empty($before)){
            $scoreList = $scoreList->where('created_at','>', $before);
        }
        $scoreList = $scoreList->get(['creator_id', DB::raw('count(*) as totalCount'), DB::raw('sum(panel_price) as totalPrice')]);*/
    }

    /**
     * @author bigsinoos <pcfeeler@gmail.com>
     * Count price of leaded orders by a user
     *
     * @param null  $start
     * @param null  $end
     * @param array $query
     * @return int
     */
    public function leadedOrdersStats($start = null, $end = null, array $query = [])
    {
        $orderTable = $this->model->getFullTableName();
        $userTable = $this->userModel->getFullTableName();
        $leadTable = $this->leadModel->getFullTableName();

        foreach($query as $key => $value){
            $query ["{$orderTable}.{$key}"] = $value;
            unset($query[$key]);
        }

        $q = $this->addSimpleWheres($this->model->newInstance()->getQuery(), $query);
        $q = $this->addStartRange($q, $start);
        $q = $this->addEndRange($q, $end);
        $q = $q->join($userTable, "{$userTable}.id" , '=', "{$orderTable}.customer_id");
        $q = $q->join($leadTable, "{$leadTable}.id", '=', "{$userTable}.lead_id");

        return $q->get([
            DB::raw('COUNT(*) as totalCount'),
            DB::raw('SUM(panel_price) as totalPrice')
        ]);
    }
}
