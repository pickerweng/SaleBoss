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

	/**
	 * Get all menues of a type
	 *
	 * @param $type
	 * @return mixed
	 */
	public function getAllInType(MenuType $type);

	/**
	 * Create a menu item
	 *
	 * @param $type
	 * @param $info
	 * @return mixed
	 */
	public function create(MenuType $type, $info);

	/**
	 * Find a Menu
	 *
	 * @param $id
	 * @return \SaleBoss\Models\Menu
	 */
	public function findById($id);

	/**
	 * Delete an item from repository
	 *
	 * @param $id
	 * @return mixed
	 */
	public function delete($id);
}