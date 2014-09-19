<?php namespace SaleBoss\Services\Leads\Creator;

interface CreatorListenerInterface {
    /**
     * What to do when creation fails
     *
     * @param $messages
     */
    public function onCreateFail($messages);

    /**
     * What to do when creation succeeds
     *
     * @param $messages
     * @return mixed
     */
    public function onCreateSuccess($messages);

} 