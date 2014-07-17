<?php namespace Controllers;

use Controllers\BaseController;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Lang;
use SaleBoss\Repositories\EntityTypeRepositoryInterface;
use SaleBoss\Repositories\Exceptions\NotFoundException;
use SaleBoss\Repositories\Exceptions\RepositoryException;
use SaleBoss\Services\EavSmartAss\EavManager;
use SaleBoss\Services\Validator\EntityTypeValidator;

class EntityTypeController  extends BaseController{

	protected $typeRepo ;
	protected $tValidator;
	protected $manager;

	/**
	 * @param EntityTypeRepositoryInterface $typeRepo
	 * @param EntityTypeValidator           $tValidator
	 * @param EavManager                    $manager
	 */
	public function __construct(
		EntityTypeRepositoryInterface $typeRepo,
		EntityTypeValidator $tValidator,
		EavManager $manager
	){
		$this->typeRepo = $typeRepo;
		$this->tValidator = $tValidator;
		$this->manager = $manager; // EavManager provides an stated interface to EavRepositoryManager
	}

	/**
	 * List entity types
	 *
	 * @return View
	 */
	public function index()
	{
		$entityTypes = $this->typeRepo->getAll();
		return $this->view(
			'admin.pages.entity_type.index',
			compact('entityTypes')
		);
	}

	/**
	 * Showing attributes of a type
	 *
	 * @param $id
	 * @return View
	 */
	public function show($id)
	{
		try {
			$attributes = $this->manager->setType($id)->getAttributes();
			$type = $this->manager->getEntityType();
			return $this->view(
				'admin.pages.entity_type.show',
				compact('attributes','type')
			);
		}catch (NotFoundException $e){
			App::abort(404);
		}
	}

	/**
	 * Edit form for EntityType
	 *
	 * @param $id
	 */
	public function edit($id)
	{
		try {
			$entityType = $this->typeRepo->findById($id);
			return $this->view(
				'admin.pages.entity_type.edit',
				compact('entityType')
			)->with('update',true);
		}catch(NotFoundException $e){
			App::abort(404);
		}
	}

	/**
	 * Deleteing an EntityType item from repository
	 *
	 * @param $id
	 */
	public function destroy($id)
	{
		try {
			$this->typeRepo->delete($id);
			return $this->redirectTo('entity_types')->with(
				'success_message',
				Lang::get('messages.operation_success')
			);
		}catch( NotFoundException $e){
			App::abort(404);
		}
	}

	/**
	 * Updating an Entity Item when ID is provided
	 *
	 * @param $id
	 * @return Redirect
	 */
	public function update($id)
	{
		$input = Input::get('item');
		if (!$valid = $this->tValidator->isValid($input))
		{
			return $this->redirectBack()->withErrors(
				$this->tValidator->getMessages()
			);
		}

		try {
			$this->typeRepo->update($id, $input);
			return $this->redirectBack()->with(
				'success_message',
				Lang::get('messages.operation_success')
			);
		}catch( RepositoryException $e){
			return $this->redirectBack()->with('error_message',Lang::get('messages.operation_error'));
		}
	}

} 