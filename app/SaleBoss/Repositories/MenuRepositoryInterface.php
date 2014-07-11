<?php

namespace SaleBoss\Repositories;


use SaleBoss\Models\MenuType;

interface MenuRepositoryInterface {

    /**
     * All menus of a type
     *
     * @param MenuType $type
     *
     * @return Collection
     */
    public function getArrayAllInType(MenuType $type);
}