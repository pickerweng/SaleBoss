<?php namespace Controllers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Lang;
use SaleBoss\Repositories\AttributeRepositoryInterface;
use SaleBoss\Repositories\Exceptions\NotFoundException;
use SaleBoss\Services\EavSmartAss\EavManager;
use SaleBoss\Services\EavSmartAss\EntityFields\Saver;
use SaleBoss\Services\EavSmartAss\EntityFields\SaverListenerInterface;

class AttributeController  extends BaseController implements SaverListenerInterface
{

	protected $attributeRepo;
	protected $manager;
	protected $saver;

	/**
	 * @param EavManager $manager
	 * @param AttributeRepositoryInterface $attributeRepo
	 * @param Saver $saver
	 */
	public function __construct(
		EavManager $manager,
		AttributeRepositoryInterface $attributeRepo,
		Saver $saver
	)
	{
		$this->manager = $manager;
		$this->attributeRepo = $attributeRepo;
		$this->saver = $saver;
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
			$rules = Config::get('validation_rules');
			if ($typeId != $attribute->entity_type_id) {
				App::abort(404);
			}
			// $options = $this->optionCollection($attribute->options);
			$type = $this->manager->setType($typeId)->getEntityType();
			return $this->view(
				'admin.pages.attribute.edit',
				compact('attribute', 'type', 'formTypes', 'options', 'update', 'rules')
			);
		} catch (NotFoundException $e) {
			App::abort(404);
		}
	}

	public function create($typeId)
	{
		try {
			$formTypes = Config::get('form_types');
			$type = $this->manager->setType($typeId)->getEntityType();
			$rules = Config::get('validation_rules');
			return $this->view(
				'admin.pages.attribute.create',
				compact('attribute', 'type', 'formTypes', 'attribute', 'rules')
			);
		} catch (NotFoundException $e) {
			App::abort(404);
		}
	}

	public function store($typeId)
	{
		$data = Input::get('item');
		return $this->saver->save($typeId, $data, $this);
	}

	/**
	 * What to do when Save fails
	 *
	 * @param $messages
	 * @return
	 */
	public function onSaveFail($messages)
	{
		return $this->redirectBack()->withErrors($messages)->withInput();
	}

	/**
	 * What to do when when validation suceeds
	 *
	 * @param $message
	 * @return
	 */
	public function onSaveSuccess($message)
	{
		return $this->redirectBack()->with('success_message', $message);
	}

	/**
	 * Delete a resource from DB
	 *
	 * @param $typeId
	 * @param $attributeId
	 */
	public function destroy($typeId, $attributeId)
	{
		try {
			$this->attributeRepo->delete($attributeId);
			return $this->redirectTo("entity_types/{$typeId}")->with(
				"success_message",
				Lang::get('messages.operation_success')
			);
		}catch (NotFoundException $e){
			App::abort(404);
		}
	}
}