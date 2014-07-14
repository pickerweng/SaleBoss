<?php

namespace SaleBoss\Repositories;


interface UserRepositoryInterface {

	/**
	 * Get All users paginated
	 *
	 * @param $number
	 * @return Collection
	 */
	public function getAllPaginated($number);

	/**
	 * Create a user in DB
	 *
	 * @param array $data
	 * @throws \SaleBoss\Repositories\Exceptions\InvalidArgumentException
	 */
	public function create(array $data);

	/**
	 * Update a user in db based on id
	 *
	 * @param $id
	 * @param $info
	 */
	public function update($id, array $info);

	/**
	 * Find the user from DB and return
	 *
	 * @param $id
	 * @return \SaleBoss\Models\User
	 */
	public function findById($id);

	/**
	 * @param $id
	 * @return Collection
	 */
	public function userWithGroups($id);

	/**
	 * Count users
	 *
	 * @param null $filter
	 * @param $remember
	 * @return int
	 */
	public function count($filter =null, $remember);

	/**
	 * Get last created user in db
	 *
	 * @return \SaleBoss\Models\User
	 */
	public function getLast();
}