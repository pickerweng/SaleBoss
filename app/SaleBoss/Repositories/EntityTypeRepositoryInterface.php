<?php
/**
 * Created by PhpStorm.
 * User: bigsinoos
 * Date: 07/07/2014
 * Time: 03:34 PM
 */

namespace SaleBoss\Repositories;


use SaleBoss\Models\Entity;

interface EntityTypeRepositoryInterface {

	/**
	 * Find an EntityType with id
	 *
	 * @param $id
	 * @return EntityType
	 */
	public function findById($id);

	/**
	 * Finds an EntityType with machine_name
	 *
	 * @param $name
	 * @return EntityType
	 */
	public function findByMachineName($name);

	/**
	 * Create an EntityType and returns the EntityType
	 *
	 * @param array $data
	 * @return EntityType
	 */
	public function create(array $data);

	/**
	 * Get Type of an Entity
	 *
	 * @param $entity
	 * @return EntityType
	 */
	public function getTypeOfEntity(Entity $entity);

	/**
	 * Get all available Entity Types
	 *
	 * @return Collection
	 */
	public function getAll();



} 