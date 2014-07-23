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
		if (empty($states))
		{
			return [];
		}
		return $this->model->with('entity')->whereIn('state_id',$states)->take($take)->get();
	}

	/**
	 * orders user has created
	 *
	 * @param $user
	 * @param $int
	 * @return Collection
	 */
	public function getGeneratedOrders($user, $int = 5)
	{
		return $this->model->newInstance()->whereHas('entity',function($query) use($user){
			$query->where('creator_id','=',$user->id);
		})->with(['targetUser','state' , 'entity'])->take($int)->get();
	}
}