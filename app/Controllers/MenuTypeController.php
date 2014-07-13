<?php namespace Controllers;


use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Lang;
use SaleBoss\Repositories\Exceptions\NotFoundException;
use SaleBoss\Repositories\MenuTypeRepositoryInterface;
use SaleBoss\Services\Validator\MenuTypeFormValidator;

class MenuTypeController extends BaseController
{

	/**
	 * @param MenuTypeRepositoryInterface $menuTypeRepo
	 * @param MenuTypeFormValidator $typeValidator
	 */
	public function __construct(
		MenuTypeRepositoryInterface $menuTypeRepo,
		MenuTypeFormValidator $typeValidator
	)
	{
		$this->menuTypeRepo = $menuTypeRepo;
		$this->typeValidator = $typeValidator;
	}

	/**
	 * List Menu Types
	 *
	 * @return mixed
	 */
	public function index()
	{
		$menu_types = $this->menuTypeRepo->all();
		return $this->view('admin.pages.menu_type.index', compact('menu_types'));
	}

	/**
	 * Creation form
	 *
	 * @return mixed
	 */
	public function create()
	{
		return $this->view('admin.pages.menu_type.create');
	}

	/**
	 * Store a repo
	 *
	 * @return mixed
	 */
	public function store()
	{
		$info = Input::get('item');
		$valid = $this->typeValidator->isValid(Input::get('item'));
		if (!$valid) {
			return $this->redirectBack()
				->withErrors($this->typeValidator->getMessages())
				->withInput();
		}
		$this->menuTypeRepo->create(Input::get('item'));
		return $this->redirectTo('menu_type')->with('success_message', Lang::get('messages.create_success'));
	}

	/**
	 * Delete from data repository
	 *
	 * @param $id
	 */
	public function destroy($id)
	{
		try {
			$this->menuTypeRepo->delete($id);
			return $this->redirectTo('menu_type')->with(
				'success_message',
				Lang::get('messages.delete_success')
			);
		}catch (NotFoundException $e) {
			App::abort(404);
		}
	}

	/**
	 * Edit Form
	 *
	 * @param $id
	 */
	public function edit($id)
	{
		try {
			$menuType = $this->menuTypeRepo->findById($id);
			return $this->view('admin.pages.menu_type.edit',compact('menuType'));
		} catch (NotFoundException $e){
			App::abort(404);
		}
	}

} 