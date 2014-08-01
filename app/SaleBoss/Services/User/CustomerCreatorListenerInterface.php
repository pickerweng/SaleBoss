<?php namespace SaleBoss\Services\User;

use SaleBoss\Models\User;

interface CustomerCreatorListenerInterface {
    /**
     * What to do when storing in db is  successful
     *
     * @param                       $message
     * @param \SaleBoss\Models\User $customer
     * @return
     */
    public function onStoreSuccess($message, User $customer);

    /**
     * What to do when storing in db is not  successful
     *
     * @param $messages
     *
     * @return
     */
    public function onStoreFail($messages);
}