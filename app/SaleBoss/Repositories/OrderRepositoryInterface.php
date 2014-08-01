<?php

namespace SaleBoss\Repositories;

use SaleBoss\Models\Order;
use SaleBoss\Models\User;

interface OrderRepositoryInterface {

    /**
     * Create order from raw data
     *
     * @param $data
     *
     * @return Order
     */
    public function createRaw(array $data);

	/**
	 * Get generated orders of users ord user
	 *
	 * @param null $user
	 * @param $int
	 * @return mixed
	 */
	public function getGeneratedOrders($user = null, $int);



	/**
	 * Get available orders of user
	 *
	 * @param User $user
	 * @param $perms
	 * @param $int
	 * @return mixed
	 */
	public function getAvailableOrders(User $user = null,$perms, $int);

	/**
	 * Count orders in month
	 *
	 * @return mixed
	 */
	public function countableMonthChart();

	/**
	 * Update order
	 *
	 * @param $order
	 * @param $data
	 * @return mixed
	 */
	public function update(Order $order,array $data);

    public function getSearchableOrders ($int);

}