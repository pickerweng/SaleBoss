<?php namespace SaleBoss\Repositories\Eloquent;

use SaleBoss\Models\Group;
use SaleBoss\Models\User;
use SaleBoss\Repositories\Collection;
use SaleBoss\Repositories\GroupRepositoryInterface;

class GroupRepository  implements GroupRepositoryInterface{

	protected  $model;

	/**
	 * @param Group $model
	 */
	public function __construct(
		Group $model
	){
		$this->model = $model;
	}

	/**
	 * Get All Groups
	 *
	 * @return Collection
	 */
	public function getAll()
	{
		return $this->model->all();
	}

	/**
	 * Get Groups of current user
	 *
	 * @param $user
	 * @return mixed
	 */
	public function getUserGroups(User $user)
	{
		return $user->getGroups();
	}
}