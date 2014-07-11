<?php namespace SaleBoss\Repositories\Eloquent;

use SaleBoss\Models\MenuType;
use SaleBoss\Repositories\MenuRepositoryInterface;

class MenuRepository implements MenuRepositoryInterface {

    /**
     * All menus of a type
     *
     * @param MenuType $type
     *
     * @return Collection
     */
    public function getArrayAllInType(MenuType $type)
    {
        return $type->menus()->get()->toArray();
    }
}