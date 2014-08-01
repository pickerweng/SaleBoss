<?php namespace SaleBoss\Repositories;

use SaleBoss\Models\Order;

interface OrderLogRepositoryInterface {
    /**
     * Store a log of order into database
     *
     * @param Order $order
     *
     * @return mixed
     */
    public function store(Order $order,$changer_id , $p_changer_id);

    public function findLastLogFor (Order $order);
}