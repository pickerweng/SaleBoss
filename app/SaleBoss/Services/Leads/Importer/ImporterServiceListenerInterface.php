<?php namespace SaleBoss\Services\Leads\Importer;

interface ImporterServiceListenerInterface {
    /**
     * What to do when import fails
     *
     * @param $messages
     * @return mixed
     */
    public function onImportFail($messages);

    /**
     * What to when saving into  database fails
     *
     * @param messages
     * @return mixed
     */
    public function onCreateFail($messages);

    /**
     * What to when creation succeeds
     *
     * @param $messages
     * @return mixed
     */
    public function onCreateSuccess($messages);
} 