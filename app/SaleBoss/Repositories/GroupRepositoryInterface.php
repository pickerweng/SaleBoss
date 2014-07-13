<?php namespace SaleBoss\Repositories;

use SaleBoss\Models\User;

interface GroupRepositoryInterface {

	/**
	 * Get All Groups
	 *
	 * @return Collection
	 */
	public function getAll();

	/**
	 * Get Groups of current user
	 *
	 * @param $user
	 * @return mixed
	 */
	public function getUserGroups(User $user);
}