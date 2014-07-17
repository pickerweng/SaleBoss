<?php namespace Controllers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use SaleBoss\Repositories\AttributeRepositoryInterface;
use SaleBoss\Repositories\Exceptions\NotFoundException;
use SaleBoss\Services\EavSmartAss\EavManager;

class AttributeController  extends BaseController{

	protected $attributeRepo;

	/**
	 * @param EavManager $manager
	 * @param AttributeRepositoryInterface $attributeRepo
	 */
	public function __construct(
		EavManager $manager,
		AttributeRepositoryInterface $attributeRepo
	){
		$this->manager = $manager;
		$this->attributeRepo = $attributeRepo;
	}

	/**
	 * Attribute Edit form
	 *
	 * @param $typeId
	 * @param $attributeId
	 * @return string
	 */
	public function edit($typeId, $attributeId)
	{
		try {
			$update = true;
			$formTypes = Config::get('form_types');
			$attribute = $this->attributeRepo->findById($attributeId);
			if ($typeId != $attribute->entity_type_id){ App::abort(404); }
			$type = $this->manager->setType($typeId)->getEntityType();
			return $this->view(
				'admin.pages.attribute.edit',
				compact('attribute','type','formTypes')
			);
		}catch (NotFoundException $e){
			App::abort(404);
		}
	}
} 