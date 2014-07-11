<?php

namespace SaleBoss\Repositories;


use SaleBoss\Models\Entity;
use SaleBoss\Models\EntityType;
use SaleBoss\Services\EavSmartAss\EavValidator;

class EavRepositoryManager implements EavRepositoryManagerInterface {

	protected $attrRepo;
	protected $typeRepo;
	protected $validator;
	protected $entityRepo;
	protected $valRepo;

	/**
	 * This class is used to handle connection between repos
	 *
	 * @param EntityTypeRepositoryInterface $typeRepo
	 * @param EntityRepositoryInterface $entityRepo
	 * @param AttributeRepositoryInterface $attrRepo
	 * @param ValueRepositoryInterface $valRepo
	 * @param EavValidator $validator
	 */
	public function __construct(
		EntityTypeRepositoryInterface $typeRepo,
		EntityRepositoryInterface $entityRepo,
		AttributeRepositoryInterface $attrRepo,
		ValueRepositoryInterface $valRepo,
		EavValidator $validator
	){
		$this->typeRepo = $typeRepo;
		$this->entityRepo = $entityRepo;
		$this->attrRepo = $attrRepo;
		$this->valRepo = $valRepo;
		$this->validator = $validator;
	}

	/**
	 * Finds an entity type when a machine_name | id is provided
	 *
	 * @param $type
	 * @return mixed
	 */
	public function findEntityType($type)
	{
		if(is_numeric($type))
		{
			return $this->typeRepo->findById($type);
		}else {
			return $this->typeRepo->findByMachineName($type);
		}
	}

	/**
	 * Gets all entities of a type if a number is provided it will get paginated
	 *
	 * @param EntityType $type
	 * @param bool $number
	 * @return mixed
	 */
	public function getEntitiesOf(EntityType $type, $number = false)
	{
		if( $number === false){
			return $this->entityRepo->getEntitiesOf($type);
		}else {
			return $this->entityRepo->getPaginatedEntitiesOf($type, $number);
		}
	}

	/**
	 * Create an entity type
	 *
	 * @param $data
	 * @return mixed
	 */
	public function createEntityType($data)
	{
		return $this->typeRepo->create($data);
	}

	/**
	 * Create an entity when EntityType is provided
	 *
	 * @param EntityType $type
	 * @param $data
	 * @return mixed
	 */
	public function createEntity(EntityType $type, $data)
	{
		return $this->entityRepo->create($type, $data);
	}

	/**
	 * Add values to database when an associated array of attribute_id => value
	 * Is provided and then filters for non allowable data
	 *
	 * @param Entity $entity
	 * @param array $values
	 * @return mixed
	 */
	public function addValuesToEntity($entity, array $values)
	{
		$values = $this->filterValueAttributes($entity, $values);
		return $this->valRepo->fillEntityWithAttributes($entity, $values);
	}

	/**
	 * Filter value attribute ids against Entity type attributes
	 *
	 * @param Entity $entity
	 * @param $values
	 * @return array
	 */
	protected function filterValueAttributes(Entity $entity , $values)
	{
		$type = $this->getTypeOfEntity($entity);
		$attributes = $this->getEntityTypeAttributes($type);
		$filtered = $this->validator->filterValues($values,$attributes,'id');
		return $filtered;
	}

	/**
	 * @param Entity $entity
	 * @return mixed
	 */
	public function getTypeOfEntity(Entity $entity)
	{
		return $this->typeRepo->getTypeOfEntity($entity);
	}

	/**
	 * @param EntityType $type
	 * @return mixed
	 */
	public function getEntityTypeAttributes(EntityType $type)
	{
		return $this->attrRepo->getAttributesOf($type);
	}

	/**
	 * @param $id
	 * @return mixed
	 */
	public function getEntity($id)
	{
		return $this->entityRepo->fullEntityById($id);
	}

	/**
	 * @param EntityType $type
	 * @param $data
	 * @return mixed
	 */
	public function addAttributesToType(EntityType $type, $data)
	{
		return $this->attrRepo->addAttributes($type, $data);
	}
}
