<?php

namespace SaleBoss\Repositories;


interface MenuTypeRepositoryInterface {

    /**
     * Find A type by its machine name
     *
     * @param $type
     *
     * @return mixed
     */
    public function findByMachineName($type);
}