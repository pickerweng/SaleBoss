<?php namespace SaleBoss\Services\User;

interface CustomerUpdaterListenerInterface {
    /**
     * What to do when update fails
     *
     * @param $messages
     *
     * @return mixed
     */
    public function onUpdateFail($messages);

    /**
     * What to do when update succeeds
     *
     * @param $message
     *
     * @return mixed
     */
    public function onUpdateSuccess($message);
}