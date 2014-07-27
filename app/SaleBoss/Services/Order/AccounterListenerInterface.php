<?php namespace SaleBoss\Services\Order;

interface AccounterListenerInterface {
    /**
     * What to do when order status is not valid
     *
     * @param $message
     *
     * @return mixed
     */
    public function onInvalidState($message);

    /**
     * What to do when Approve success
     *
     * @param $message
     *
     * @return mixed
     */
    public function onApporveSuccess($message);

    /**
     * What to when order deports
     *
     * @param $message
     *
     * @return mixed
     */
    public function onDeport($message);
}