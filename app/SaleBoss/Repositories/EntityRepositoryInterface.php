<?php
/**
 * Created by PhpStorm.
 * User: bigsinoos
 * Date: 07/07/2014
 * Time: 03:56 PM
 */

namespace SaleBoss\Repositories;


use SaleBoss\Models\EntityType;

interface EntityRepositoryInterface {
	/**
	 * Gets all entities of a given type
	 *
	 * @param EntityType $type
	 * @return mixed
	 */
	public function getEntitiesOf(EntityType $type);

	/**
	 * Gets paginated entities of a type
	 *
	 * @param EntityType $type
	 * @param bool $number
	 * @return mixed
	 */
	public function getPaginatedEntitiesOf(EntityType $type, $number = false);

	/**
	 * Creates an Entity that belongs to an EntityType and returns id
	 *
	 * @param EntityType $type
	 * @param $data
	 * @return Entity
	 */
	public function create(EntityType $type,$data);

	/**
	 * Get Full entity with attributes and values
	 * @param $id
	 * @return mixed
	 */
	public function fullEntityById($id);

	public function countableMonthChart(EntityType $type = null);


} 