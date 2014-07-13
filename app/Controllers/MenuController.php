<?php namespace Controllers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Response;
use SaleBoss\Repositories\Exceptions\NotFoundException;
use SaleBoss\Repositories\MenuRepositoryInterface;
use SaleBoss\Repositories\MenuTypeRepositoryInterface;
use SaleBoss\Services\Validator\MenuFormValidator;

class MenuController  extends BaseController{

	/**
	 * @param MenuRepositoryInterface $menuRepo
	 * @param MenuTypeRepositoryInterface $typeRepo
	 * @param MenuFormValidator $menuValidator
	 */
	public function __construct(
		MenuRepositoryInterface $menuRepo,
		MenuTypeRepositoryInterface $typeRepo,
		MenuFormValidator $menuValidator
	){
		$this->menuRepo = $menuRepo;
		$this->typeRepo = $typeRepo;
		$this->menuValidator = $menuValidator;
	}

	/**
	 * List all menus of a type
	 *
	 * @param $id
	 */
	public function index($id)
	{
		try {
			$type = $this->typeRepo->findById($id);
			$menuItems = $this->menuRepo->getAllInType($type);
			return $this->view('admin.pages.menu.index',compact('type','menuItems'));
		}catch(NotFoundException $e)
		{
			App::abort(404);
		}
	}

	/**
	 * Menu Creation Form
	 *
	 * @return View
	 */
	public function create()
	{
		$types = $this->typeRepo->all();
		return $this->view('admin.pages.menu.create',compact('types'));
	}

	/**
	 * Store a Menu in Repo
	 * @TODO Moving the job to a service
	 *
	 * @return Redirect
	 */
	public function store()
	{
		$info = Input::get('item');
		$valid = $this->menuValidator->isValid($info);
		if (!$valid){
			return $this->redirectBack()
						->withInput()
						->withErrors($this->menuValidator->getMessages());
		}

		$select = explode('_',$info['ids']);
		$parentId = null;
		$typeId = null;
		if (empty($select[0]))
			return $this->redirectBack()->with('error_message','منو باید به یک نوع تعلق داشته باشد.');

		try {
			$type = $this->typeRepo->findById($select[0]);
			if(!empty($select[1])){
				$info['parent_id'] = $select[1];
			}
			$this->menuRepo->create($type, $info);
			return $this->redirectBack()->with('success_message',Lang::get('messages.operation_success'));
		}catch(NotFoundException $e){
			return $this->redirectBack()->with(
				'error_message',
				Lang::get('messages.operation_error')
			);
		}
	}

	public function delete($id)
	{

	}

} 