<?php

namespace SaleBoss\Repositories\Eloquent;

use SaleBoss\Models\User;
use SaleBoss\Repositories\Collection;
use SaleBoss\Repositories\UserRepositoryInterface;

class UserRepository extends AbstractRepository implements UserRepositoryInterface {

	protected $model;

	/**
	 * @param User $model
	 */
	public function __construct(
		User $model
	){
		$this->model = $model;
	}

	/**
	 * Get All users paginated
	 *
	 * @param $number
	 * @return Collection
	 */
	public function getAllPaginated($number)
	{
		$model = $this->model->newInstance();
		return $model->paginate($number);
	}
}