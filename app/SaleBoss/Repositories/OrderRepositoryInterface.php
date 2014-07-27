<?php

namespace SaleBoss\Repositories;

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

    public function getAvailableOrders($perms, $int);

    public function countableMonthChart();
}