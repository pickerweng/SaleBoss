<?php

namespace SaleBoss\Services\EavSmartAss;

use SaleBoss\Repositories\EavRepositoryManagerInterface;
use Whoops\Example\Exception;

class EavManager implements  EavManagerInterface {

	protected $repoManager;
	protected $type;
	protected $entity;
	protected $values;

	/**
	 * @param EavRepositoryManagerInterface $repoManager
	 */
	public function __construct(
		EavRepositoryManagerInterface $repoManager
	){
		$this->repoManager = $repoManager;
	}

	/**
	 * Uses Repository manager to  set type of
	 * entity for current state of the class
	 *
	 * @param $type
	 * @return $this
	 */
	public function setType($type)
	{
		$this->type = $this->repoManager->findEntityType($type);
		return $this;
	}

	/**
	 * Gets All entities of current type
	 *
	 * @param bool $number
	 * @return mixed
	 */
	public function getEntities($number = false)
	{
		return $this->repoManager->getEntitiesOf($this->type, $this->type);
	}

	/**
	 * Gets entity and sets it
	 *
	 * @param $id
	 * @return $this
	 */
	public function setEntity($id)
	{
		$this->entity = $this->repoManager->getEntity($id);
		return $this;
	}

	public function getEntity()
	{
		return $this->entity;
	}

	/**
	 * Creates an entity type and sets it for
	 * current state of the object
	 *
	 * @param $data
	 * @return $this
	 */
	public function createAndSetEntityType(array $data)
	{
		$this->type = $this->repoManager->createEntityType($data);
		return $this;
	}

	/**
	 * Gets existing attributes of type
	 *
	 * @return mixed
	 */
	public function getAttributes()
	{
		return $this->repoManager->getEntityTypeAttributes($this->type);
	}

	/**
	 * @param array $attributes
	 * @return $this
	 */
	public function addAttributes(array $attributes)
	{
		$this->type = $this->repoManager->addAttributesToType($this->type, $attributes);
		return $this;
	}

	/**
	 * Create an Entity fore current state type
	 * @param array $data
	 * @return mixed
	 */
	public function createAndSetEntity(array $data)
	{
		return $this->entity = $this->repoManager->createEntity($this->type, $data);
	}

	/**
	 * @param $attributeId
	 * @param $value
	 * @return $this
	 */
	public function addValue($attributeId, $value)
	{
		if ($value === '') return $this;
		$this->values[$attributeId] = $value;
		return $this;
	}

	/**
	 * Save current state as an EAV model
	 *
	 * @return Entities
	 */
	public function saveValues()
	{
		return $this->entity = $this->repoManager->addValuesToEntity($this->entity, $this->getValues());
	}

	/**
	 * Get values
	 *
	 * @return array
	 */
	public function getValues()
	{
		return $this->values;
	}

	/**
	 * Get Entity type of the current state of the object
	 *
	 * @return EntityType
	 */
	public function getEntityType()
	{
		return $this->type;
	}

	public function getRepoManager()
	{
		return $this->repoManager;
	}
}