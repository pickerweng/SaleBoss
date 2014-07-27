<?php

namespace SaleBoss\Repositories;

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

    public function getGeneratedOrders($user, $int);

    public function getAvailableOrders(User $user = null,$perms, $int);

    public function countableMonthChart();

	/**
	 * @param $orderId
	 * @param $int state
	 * @param $approved
	 * @param $description
	 * @return mixed
	 */
	public function stateUpdate($orderId,$int, $approved, $description);
}