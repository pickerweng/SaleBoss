<?php

namespace SaleBoss\Repositories;


use SaleBoss\Models\EntityType;

interface EavRepositoryManagerInterface {

	public function getEntityTypeAttributes(EntityType $type);

	public function findEntityType($type);

	public function getEntitiesOf(EntityType $type, $number = false);

	public function getEntity($id);

	public function createEntityType($data);

	public function addAttributesToType(EntityType $type, $attributes);

	public function createEntity(EntityType $type, $data);
}