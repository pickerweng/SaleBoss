<?php

namespace SaleBoss\Repositories\Eloquent;

use SaleBoss\Models\Attribute;
use SaleBoss\Models\EntityType;
use SaleBoss\Repositories\AttributeRepositoryInterface;

class AttributeRepository implements AttributeRepositoryInterface   {

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
	 * @return array|EntityType
	 */
	public function addAttributes(EntityType $type, $data)
	{
		if( empty($data))
			return $type;

		return $type->attributes()->saveMany($this->prepareAttributes($data));
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
			$toSave[] = $attributeRecord;
		}
		return $toSave;
	}
}