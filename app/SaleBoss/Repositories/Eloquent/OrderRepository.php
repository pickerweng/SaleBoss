<?php

namespace SaleBoss\Repositories\Eloquent;

use SaleBoss\Models\Entity;
use SaleBoss\Models\Order;
use SaleBoss\Models\User;
use SaleBoss\Repositories\OrderRepositoryInterface;

class OrderRepository implements OrderRepositoryInterface {

	/**
	 *
	 * @param Order $model
	 */
	public function __construct(
		Order $model
	){
		$this->model = $model;
	}

	public function create(Entity $entity, array $data)
	{
		$model = $this->model->newInstance();
		$model->entity_id = $entity->id;
		$model->target_user_id = $data['target_user_id'];
		$model->state_id = $data['state_id'];
		$model->save();
		return $model;
	}

	/**
	 * Get available possible user orders
	 *
	 * @param array $states
	 * @param int $take
	 * @return mixed
	 */
	public function getAvailableOrders(array $states, $take = 10)
	{
		return $this->model->with('entity')->whereIn('state_id',$states)->take($take);
	}
}