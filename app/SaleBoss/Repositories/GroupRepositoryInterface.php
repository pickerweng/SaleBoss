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

	/**
	 * Add
	 *
	 * @param User $user
	 * @param array $groups
	 * @return \SaleBoss\Models\User
	 */
	public function addGrooupsToUser(User $user,$groups);

	/**
	 * Create a group in Repo
	 *
	 * @param array $data
	 * @return \SaleBoss\Models\Group
	 */
	public function create(array $data);

	/**
	 * Find a group by its id
	 *
	 * @param $id
	 * @return mixed
	 */
	public function findById($id);
}