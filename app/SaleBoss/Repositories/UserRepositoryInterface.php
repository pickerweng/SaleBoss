<?php

namespace SaleBoss\Repositories;


use SaleBoss\Models\User;

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

	/**
	 * Get generated users in count
	 *
	 * @param User $user
	 * @param int $count
	 * @return Collection
	 */
	public function getGeneratedUsers(User $user,$count = 5);

    /**
     * Create from raw array
     *
     * @param $data
     *
     * @return Model
     */
    public function createRaw(array $data);

    /**
     * Get all customers of a user
     *
     * @param User  $user
     * @param       $int
     * @param array $searches
     *
     * @return Collection
     */
    public function getCustomers( $user = null, $int, array $searches);

    /**
     * Find a customer
     *
     * @param $id
     *
     * @return Model
     */
    public function findCustomer($id);

    /**
     * Perform raw update
     *
     * @param $customer
     * @param $data
     *
     * @return mixed
     */
    public function rawUpdate($customer, $data);

    /**
     * @author bigsinoos <pcfeeler@gmail.com>
     * Count table with conditions
     *
     * @param null $start
     * @param null $end
     * @param array $query
     * @return int
     */
    public function countWithQuery($start = null, $end = null, array $query = []);

    /**
     * @author bigsinoos <pcfeeler@gmail.com>
     * Count all customers of the user entity
     *
     * @param null $start
     * @param null $end
     * @param array $query
     * @return int
     */
    public function countAllCustomers($start = null, $end = null, array $query = array());

    /**
     * @author bigsinoos <pcfeeler@gmail.com>
     * Count all  of the entity
     *
     * @param null $startP
     * @param null $end
     * @param array $query
     * @return int
     */
    public function countAllUsers($start = null, $end = null, array $query = array());

    /**
     * @author bigsinoos <pcfeeler@gmail.com>
     * Count all users that has came from leads
     *
     * @param null $start
     * @param null $end
     * @param array $query
     * @return int
     */
    public function countWithLead($start = null, $end = null, array $query = array());
}
