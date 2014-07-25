<?php namespace SaleBoss\Services\User;

interface CustomerCreatorListenerInterface {
    /**
     * What to do when storing in db is  successful
     *
     * @param $message
     *
     *
     * @return
     */
    public function onStoreSuccess($message);

    /**
     * What to do when storing in db is not  successful
     *
     * @param $messages
     *
     * @return
     */
    public function onStoreFail($messages);
}