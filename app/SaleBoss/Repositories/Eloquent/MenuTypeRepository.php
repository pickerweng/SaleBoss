<?php namespace SaleBoss\Repositories\Eloquent;

use SaleBoss\Models\MenuType;
use SaleBoss\Repositories\Exceptions\MenuTypeNotFoundException;
use SaleBoss\Repositories\MenuTypeRepositoryInterface;

class MenuTypeRepository extends AbstractRepository implements MenuTypeRepositoryInterface
{

	/**
	 * @param MenuType $model
	 */
	public function __construct(
		MenuType $model
	)
	{
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
		$model = $model->where('machine_name', $type)->first();
		if (is_null($model)) {
			throw new MenuTypeNotFoundException("No menu type with machine_name: [{$type}]");
		}
		return $model;
	}

	/**
	 * All menu types
	 *
	 * @return \Illuminate\Database\Eloquent\Collection|static[]
	 */
	public function all()
	{
		$model = $this->model->newInstance();
		return $model->all();
	}

	public function create(array $info)
	{
		$model = $this->model->newInstance();
		$model->machine_name = $info['machine_name'];
		$model->display_name = $info['display_name'];
		$model->disabled = empty($info['disabled']) ? false  : true;
		$model->save();
		return $model;
	}

	/**
	 *  Get all menues with all types
	 *
	 * @return array
	 */
	public function getArrayAllWithMenus(){
		$model = $this->model->newInstance();
		$items = $model->with('menus')->get()->toArray();
		return $items;
	}

}