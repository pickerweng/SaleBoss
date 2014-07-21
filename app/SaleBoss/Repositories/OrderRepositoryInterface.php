<?php

namespace SaleBoss\Repositories;

use SaleBoss\Models\User;

interface OrderRepositoryInterface {

	/**
	 * Get available possible user orders
	 *
	 * @param $states
	 * @return mixed
	 */
	public function getAvailableOrders(array $states, $take);
}