<?php
/**
 * Created by PhpStorm.
 * User: bigsinoos
 * Date: 07/07/2014
 * Time: 03:35 PM
 */

namespace SaleBoss\Repositories;

use SaleBoss\Models\EntityType;

interface AttributeRepositoryInterface {

	/**
	 * Get all attributes of a type
	 *
	 * @param EntityType $type
	 * @return mixed
	 */
	public function getAttributesOf(EntityType $type);

	public function addAttributes(EntityType $type, $data);
}