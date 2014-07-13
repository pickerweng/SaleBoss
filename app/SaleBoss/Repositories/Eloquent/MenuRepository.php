<?php namespace SaleBoss\Repositories\Eloquent;

use SaleBoss\Models\Menu;
use SaleBoss\Models\MenuType;
use SaleBoss\Repositories\MenuRepositoryInterface;

class MenuRepository  extends AbstractRepository implements MenuRepositoryInterface {

	/**
	 * @param Menu $model
	 */
	public function __construct(
		Menu $model
	){
		$this->model = $model;
	}

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

	/**
	 * Get all menues of a type
	 *
	 * @param $type
	 * @return mixed
	 */
	public function getAllInType(MenuType $type)
	{
		return $type->menus()->get();
	}

	/**
	 * Create a menu item
	 *
	 * @param $type
	 * @param $info
	 * @return mixed
	 */
	public function create(MenuType $type, $info)
	{
		$model = $this->model->newInstance();
		$model->title = $info['title'];
		$model->uri = $info['uri'];
		$model->description = (!empty($info['description']) ? $info['description'] : '');
		$model->parent_id = !empty($info['parent_id']) ? $info['parent_id'] : null;
		$model->menu_type_id = $type->id;
		$model->save();
		return $model;
	}
}