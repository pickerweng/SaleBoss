<?php
namespace SaleBoss\Repositories;

use SaleBoss\Models\EntityType;

interface AttributeRepositoryInterface
{

    /**
     * Get all attributes of a type
     *
     * @param EntityType $type            
     * @return mixed
     */
    public function getAttributesOf(EntityType $type);

    public function addAttributes(EntityType $type, $data);
}