<?php namespace SaleBoss\Services\Order;

interface CreatorListenerInterface {
    /**
     * What to do when creation fails
     *
     * @param $messages
     *
     * @return mixed
     */
    public function onCreateFail($messages);

    /**
     * What to do when creation succeeds
     *
     * @param null $message
     *
     * @return mixed
     */
    public function onCreateSuccess($message = null);
}