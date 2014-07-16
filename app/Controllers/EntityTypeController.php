<?php namespace Controllers;

use Controllers\BaseController;
use SaleBoss\Repositories\EntityTypeRepositoryInterface;
use SaleBoss\Services\Validator\EntityTypeValidator;

class EntityTypeController  extends BaseController{

	protected $typeRepo ;
	protected $tValidator;

	/**
	 * @param EntityTypeRepositoryInterface $typeRepo
	 * @param EntityTypeValidator $tValidator
	 */
	public function __construct(
		EntityTypeRepositoryInterface $typeRepo,
		EntityTypeValidator $tValidator
	){
		$this->typeRepo = $typeRepo;
		$this->tValidator = $tValidator;
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

	public function show($id)
	{

	}

	public function edit($id)
	{

	}

	public function delete($id)
	{

	}

	public function update($id)
	{

	}

} 