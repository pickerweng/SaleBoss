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

	/**
	 * All menu types for listing
	 *
	 * @return Collection
	 */
	public function all();

	/**
	 * Create a menu type
	 *
	 * @param array $data
	 * @return mixed
	 */
	public function create( array $data);

	/**
	 * Delete a MenuType based on id
	 *
	 * @param $id
	 * @return boolean
	 */
	public function delete($id);

	/**
	 * Find a Repo by id
	 *
	 * @param $id
	 * @return mixed
	 */
	public function findById($id);

	/**
	 * Get all types with menus
	 *
	 * @return mixed
	 */
	public function getArrayAllWithMenus();
}