<?php
/**
 * Created by PhpStorm.
 * User: bigsinoos
 * Date: 07/07/2014
 * Time: 03:45 PM
 */

namespace SaleBoss\Repositories\Eloquent;


use SaleBoss\Models\Entity;
use SaleBoss\Models\Value;
use SaleBoss\Repositories\ValueRepositoryInterface;

class ValueRepository implements ValueRepositoryInterface {

	protected $model;

	public function __construct(
		Value $model
	){
		$this->model = $model;
	}

	/**
	 * Add values to Entity
	 *
	 * @param $entity
	 * @param $values
	 * @return Entity
	 */
	public function fillEntityWithAttributes(Entity $entity, $values)
	{
		if(empty($values))
			return true;

		$entity->entityValues()->saveMany($this->prepareInsert($values));
		return $entity;
	}

	/**
	 * @param $values
	 * @return array
	 */
	protected function prepareInsert($values)
	{
		$data = [];
		foreach($values as $key => $value){
			$valueRecord = $this->model->newInstance();
			$valueRecord->attribute_id = $key;
			$valueRecord->value = $value;
			$data[] = $valueRecord;
		}
		return $data;
	}
}