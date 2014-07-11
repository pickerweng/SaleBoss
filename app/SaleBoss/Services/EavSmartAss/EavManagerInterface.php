<?php

namespace SaleBoss\Services\EavSmartAss;


interface EavManagerInterface {

	/**
	 * Set type of current state of the object
	 *
	 * @param $type
	 * @return $this
	 */
	public function setType($type);

	/**
	 * Get all entities of the current entity type
	 *
	 * @param bool $number
	 * @return mixed
	 */
	public function getEntities($number =false);

	/**
	 * Sets an entity for current object state
	 *
	 * @param $id
	 * @return mixed
	 */
	public function setEntity($id);

	/**
	 * Creates and sets entity type for current state of the object
	 *
	 * @param array $data
	 * @return mixed
	 */
	public function createAndSetEntityType(array $data);


	/*
	 * Returns current entity of the object
	 *
	 * @return Entity
	 */
	public function getEntity();

	/**
	 * Gets all attributes of the current type
	 *
	 * @return mixed
	 */
	public function getAttributes();

	/**
	 * Add attributes to currrent type
	 *
	 * @param array $attributes
	 * @return EntityType
	 */
	public function addAttributes(array $attributes);

	/**
	 * Creates an entity and adds it to current state
	 *
	 * @param array $data
	 * @return mixed
	 */
	public function createAndSetEntity(array $data);

	/**
	 * Adds value-attribute pairs to current state of the object
	 *
	 * @param $attributeId
	 * @param $value
	 * @return $this
	 */
	public function addValue($attributeId, $value);

	/**
	 * Saves an Entity with Attributes
	 *
	 * @return Entity
	 */
	public function saveValues();

	/**
	 * Get Entity type of the current state of the object
	 *
	 * @return EntityType
	 */
	public function getEntityType();


} 