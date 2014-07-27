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
}