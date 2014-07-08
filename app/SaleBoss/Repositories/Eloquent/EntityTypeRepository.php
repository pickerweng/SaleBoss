<?php

namespace SaleBoss\Repositories\Eloquent;


use SaleBoss\Models\Entity;
use SaleBoss\Models\EntityType;
use SaleBoss\Repositories\EntityTypeRepositoryInterface;
use SaleBoss\Repositories\Exceptions\EntityTypeNotFoundException;

class EntityTypeRepository implements EntityTypeRepositoryInterface {

	protected $model;

	public function __construct(
		EntityType $model
	){
		$this->model = $model;
	}

	public function findById($id)
	{
		$type = $this->model->find($id);
		if ( is_null($type)){
			throw new EntityTypeNotFoundException("Entity Type not found with id : {$id} Notfound");
		}

		return $type;
	}

	public function findByMachineName($name)
	{
		$type = $this->model->where('machine_name',$name)->first();
		if (is_null($type)){
			throw new EntityTypeNotFoundException("Entity Type witth machine_name : {$name} not found");
		}
		return $type;
	}

	/**
	 * Create an EntityType and returns the EntityType
	 *
	 * @param array $data
	 * @return \SaleBoss\Repositories\EntityType
	 */
	public function create(array $data)
	{
		$type = $this->model->newInstance();
		$type->machine_name = $data['machine_name'];
		$type->display_name = $data['display_name'];
		$type->save();
		return $type;
	}

	/**
	 * Get Type of an Entity
	 *
	 * @param $entity
	 * @return \SaleBoss\Repositories\EntityType
	 */
	public function getTypeOfEntity(Entity $entity)
	{
		return $entity->entityType()->first();
	}
}