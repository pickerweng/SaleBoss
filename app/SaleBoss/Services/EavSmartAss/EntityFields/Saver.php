<?php namespace SaleBoss\Services\EavSmartAss\EntityFields;

use Illuminate\Support\Facades\Lang;
use SaleBoss\Repositories\AttributeRepositoryInterface;
use SaleBoss\Repositories\Exceptions\NotFoundException;
use SaleBoss\Repositories\Exceptions\RepositoryException;
use SaleBoss\Services\EavSmartAss\EavManager;
use SaleBoss\Services\Validator\AttributeValidator;
use SaleBoss\Services\Validator\DynamicAttributeValidator;

class Saver {

	protected $manager;
	protected $attrRepo;
	protected $aValidator;
	protected $data;
	protected $dynamicValidator;

	/**
	 * @param EavManager $eavManager
	 * @param AttributeRepositoryInterface $attrRepo
	 * @param AttributeValidator $aValidator
	 * @param DynamicAttributeValidator $dynamicValidator
	 */
	public function  __construct(
		EavManager $eavManager,
		AttributeRepositoryInterface $attrRepo,
		AttributeValidator $aValidator,
		DynamicAttributeValidator $dynamicValidator
	){
		$this->manager = $eavManager;
		$this->attrRepo = $attrRepo;
		$this->aValidator = $aValidator;
		$this->dynamicValidator = $dynamicValidator;
	}

	/**
	 * Process Save
	 *
	 * @param $typeId
	 * @param $data
	 * @param SaverListenerInterface $li
	 * @retrun SaverListenerInterface
	 */
	public function save($typeId, $data, SaverListenerInterface $li)
	{
		$this->data = $data;

		if ( ! $this->checkSetType($typeId)){
			return $li->onSaveFail([Lang::get('messages.item_not_found')]);
		}

		if ( ! $valid = $this->aValidator->isValid($data)){
			return $li->onSaveFail($this->aValidator->getMessages());
		}

		if (!empty($data['rules']) && !empty($data['default_value'])){
			$this->dynamicValidator->setRules('default_value', $data['rules']);
			if (! $valid = $this->dynamicValidator->isValid($data)){
				return $li->onSaveFail($this->dynamicValidator->getMessages());
			}
		}

		try {
			$this->processSave();
			return $li->onSaveSuccess(Lang::get('messages.operation_success'));
		}catch (RepositoryException $e){
			return $li->onSaveFail(Lang::get('messages.operation_error'));
		}
	}

	/**
	 * Get options
	 *
	 * @return string
	 */
	protected  function prepareOptionCollection()
	{
		if(empty($this->data['options'])) return;
		$options = [];
		foreach($this->data['options'] as $key => $option)
		{
			$options[] = ['key' => $key, 'value' => $option ];
		}
		return $this->data['options'] = json_encode($options);
	}

	/**
	 * Check and set type
	 *
	 * @param $typeId
	 * @return bool
	 */
	protected function checkSetType($typeId)
	{
		try {
			$this->manager->setType($typeId);
			return true;
		}catch (NotFoundException $e){
			return false;
		}
	}

	/**
	 * Process save
	 *
	 * @return void
	 */
	protected function processSave()
	{
		$this->prepareOptionCollection();
		$this->manager->addAttributes([$this->data]);
	}
} 
