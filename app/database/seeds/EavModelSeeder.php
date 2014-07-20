<?php

use SaleBoss\Models\Attribute;
use SaleBoss\Models\Entity;
use SaleBoss\Models\EntityType;
use SaleBoss\Models\Value;

class EavModelSeeder extends Seeder{

	/**
	 * Seed the EAV Model based on the Fucking Faking
	 */
	public function run()
	{
		$entityType = new EntityType;
		$entityType->machine_name = "example_machine_name" . time();
		$entityType->display_name = "Example Display Name";
		$entityType->save();

		$entity = new Entity;
		$entity->title = "Example Entity";
		$entity->description = "Example Entity Description";
		$entity->data = json_encode(['example_additional_data' => 'example_additional_data_value']);

		$entityType->entities()->save($entity);

		Attribute::insert([
			[
				'entity_type_id'        =>  $entityType->id,
				'display_name'          =>  "Example Attribute 1",
				'machine_name'          =>  "example_machine_name",
				'form_type'             =>  0
			],
			[
				'entity_type_id'        =>  $entityType->id,
				'display_name'          =>  "Example Attribute 2",
				'machine_name'          =>  "example_machine_name_two",
				'form_type'             =>  1
			]
		]);

		$attributes = $entityType->attributes()->get(array('id'));

		$data = array();

		foreach($attributes as $attribute)
		{
			$tmpData['attribute_id'] = $attribute->id;
			$tmpData['entity_id'] = $entity->id;
			$tmpData['value'] = time();
			$data[] = $tmpData;
		}

		Value::insert($data);

		$this->command->info("Fucking no other solution EAV!!!!");

	}
} 