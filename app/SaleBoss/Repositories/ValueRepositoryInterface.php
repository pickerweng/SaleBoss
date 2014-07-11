<?php

namespace SaleBoss\Repositories;

use SaleBoss\Models\Entity;

interface ValueRepositoryInterface {

	/**
	 * Add values to Entity
	 *
	 * @param $entity
	 * @param $values
	 * @return Entity
	 */
	public function fillEntityWithAttributes(Entity $entity, $values);
} 