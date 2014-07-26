<?php

namespace SaleBoss\Repositories\Eloquent;

use SaleBoss\Models\Entity;
use SaleBoss\Models\Order;
use SaleBoss\Models\User;
use SaleBoss\Repositories\OrderRepositoryInterface;

class OrderRepository implements OrderRepositoryInterface {

	protected $model;

	/**
	 * @param Order $order
	 */
	public function __construct(
		Order $order
	){
		$this->model = $order;
	}
}