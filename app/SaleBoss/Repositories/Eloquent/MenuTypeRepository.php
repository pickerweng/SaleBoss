<?php
/**
 * Created by PhpStorm.
 * User: bigsinoos
 * Date: 07/07/2014
 * Time: 03:44 PM
 */

namespace SaleBoss\Repositories\Eloquent;


use SaleBoss\Models\MenuType;
use SaleBoss\Repositories\Exceptions\MenuTypeNotFoundException;
use SaleBoss\Repositories\MenuTypeRepositoryInterface;

class MenuTypeRepository implements MenuTypeRepositoryInterface {

    /**
     * @param MenuType $model
     */
    public function __construct(
        MenuType $model
    ){
        $this->model = $model;
    }

    /**
     * Find A type by its machine name
     *
     * @param $type
     *
     * @throws MenuTypeNotFoundException
     * @return MenuType
     */
    public function findByMachineName($type)
    {
        $model = $this->model->newInstance();
        $model = $model->where('machine_name',$type)->first();
        if (is_null($model)){
            throw new MenuTypeNotFoundException("No menu type with machine_name: [{$type}]");
        }
        return $model;
    }
}