<?php

namespace SaleBoss\Repositories\Eloquent;

use Illuminate\Database\QueryException;
use SaleBoss\Models\Attribute;
use SaleBoss\Models\EntityType;
use SaleBoss\Repositories\AttributeRepositoryInterface;
use SaleBoss\Repositories\Exceptions\RepositoryException;

class AttributeRepository extends AbstractRepository implements AttributeRepositoryInterface   {

	public function __construct(
		Attribute $model
	){
		$this->model = $model;
	}

	/**
	 * Get all attributes of a type
	 *
	 * @param EntityType $type
	 * @return mixed
	 */
	public function getAttributesOf(EntityType $type)
	{
		return $type->attributes()->get();
	}

	/**
	 * @param EntityType $type
	 * @param $data
	 * @throws \SaleBoss\Repositories\Exceptions\RepositoryException
	 * @return array|EntityType
	 */
	public function addAttributes(EntityType $type, $data)
	{
		if( empty($data))
			return $type;
		try {
			return $type->attributes()->saveMany($this->prepareAttributes($data));
		}catch (QueryException $e){
			throw new RepositoryException($e->getMessage());
		}
	}

	/**
	 * @param $attributes
	 * @return array
	 */
	protected function prepareAttributes($attributes){
		$toSave = [];
		foreach($attributes as $attribute){
			$attributeRecord = $this->model->newInstance();
			$attributeRecord->machine_name = $attribute['machine_name'];
			$attributeRecord->display_name = $attribute['display_name'];
			$attributeRecord->form_type = !empty($attribute['form_type']) ? $attribute['form_type'] : 0;
			$attributeRecord->options = !empty($attribute['options']) ? $attribute['options'] : null;
			$attributeRecord->exclude = !empty($attribute['exclude']) ? true : false;
			$attributeRecord->default_value = !empty($attribute['default_value']) ? $attribute['default_value'] : null;
			$toSave[] = $attributeRecord;
		}
		return $toSave;
	}
}