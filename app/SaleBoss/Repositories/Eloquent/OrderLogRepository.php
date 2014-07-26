<?php namespace SaleBoss\Repositories\Eloquent;

use SaleBoss\Models\OrderLog;
use SaleBoss\Repositories\OrderRepositoryInterface;

class OrderLogRepository extends AbstractRepository implements OrderRepositoryInterface {

	protected $model;

	/**
	 * @param OrderLog $orderLog
	 */
	public function __construct(
		OrderLog $orderLog
	){
		$this->model = $orderLog;
	}
} 