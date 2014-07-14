<?php

namespace SaleBoss\Repositories\Eloquent;

use Illuminate\Database\QueryException;
use SaleBoss\Models\User;
use SaleBoss\Repositories\Collection;
use SaleBoss\Repositories\Exceptions\InvalidArgumentException;
use SaleBoss\Repositories\Exceptions\NotFoundException;
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

	/**
	 * Create a user in DB
	 *
	 * @param array $data
	 * @throws \SaleBoss\Repositories\Exceptions\InvalidArgumentException
	 */
	public function create(array $data)
	{
		$model = $this->model->newInstance();
		try {
			return $model->create($data);
		}catch(QueryException $e){
			throw new InvalidArgumentException($e->getMessage());
		}
	}

	/**
	 * Updates a user in db
	 *
	 * @param $id
	 * @param array $data
	 * @throws \SaleBoss\Repositories\Exceptions\InvalidArgumentException
	 * @throws \SaleBoss\Repositories\Exceptions\NotFoundException
	 */
	public function update($id, array $data)
	{
		try {
			$model = $this->model->newInstance();
			$model = $model->find($id);
			if(is_null($model)){
				throw new NotFoundException("No item with id : [{$id}] found");
			}
			return $model->update($data);
		}catch(QueryException $e){
			throw new InvalidArgumentException($e->getMessage());
		}
	}


	/**
	 * Find a user with groups
	 *
	 * @param $id
	 * @throws \SaleBoss\Repositories\Exceptions\NotFoundException
	 * @return Collection
	 */
	public function userWithGroups($id)
	{
		$model = $this->model->newInstance();
		$model = $model->with('groups')->find($id);
		if (is_null($model)){
			throw new NotFoundException("User with id : [{$id}] not found");
		}
		return $model;
	}

	/**
	 * Count users
	 *
	 * @param   null    $filter
	 * @param   int     $remember
	 * @return  int
	 */
	public function count($filter = null,$remember = 0)
	{
		if(empty($filter))
		{
			return $this->model->remember($remember)->count();
		}
		return $this->model->remember($remember)->where($filter,true)->count();
	}

	/**
	 * Get last created user in db
	 *
	 * @return \SaleBoss\Models\User
	 */
	public function getLast()
	{
		$model = $this->model->orderBy('created_at','desc')->first();
		return $model;
	}
}