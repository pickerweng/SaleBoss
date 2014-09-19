<?php namespace SaleBoss\Services\Menu;


interface BuilderInterface {

    /**
     * Fetch the results
     *
     * @param $type
     *
     * @return mixed
     */
    public function fetch($type);

    /**
     * Make html output
     *
     * @param $type
     *
     * @return string
     */
    // public function html($type);
}