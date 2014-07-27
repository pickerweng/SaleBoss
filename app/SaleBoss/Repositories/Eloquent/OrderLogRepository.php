<?php namespace SaleBoss\Repositories\Eloquent;

use SaleBoss\Models\Order;
use SaleBoss\Models\OrderLog;
use SaleBoss\Repositories\OrderLogRepositoryInterface;
class OrderLogRepository extends AbstractRepository implements OrderLogRepositoryInterface {

	protected $model;

	/**
	 * @param OrderLog $orderLog
	 */
	public function __construct(
		OrderLog $orderLog
	){
		$this->model = $orderLog;
	}

    /**
     * Store a log of order into database
     *
     * @param Order $order
     * @param       $changer_id
     * @param       $p_changer_id
     *
     * @return mixed
     */
    public function store(Order $order,$changer_id, $p_changer_id)
    {
        $jsonOrder = $order->toJson();
        $orderLog = $this->model->newInstance();
        $orderLog->data = $jsonOrder;
        $orderLog->changer_id = $changer_id;
        $orderLog->previous_changer_id = $p_changer_id;
        $orderLog->order_id = $order->id;
        $orderLog->save();
        return $orderLog;
    }
}