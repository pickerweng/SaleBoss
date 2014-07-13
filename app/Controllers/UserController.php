<?php

namespace Controllers;


use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Input;
use SaleBoss\Repositories\Exceptions\NotFoundException;
use SaleBoss\Repositories\GroupRepositoryInterface;
use SaleBoss\Repositories\UserRepositoryInterface;
use SaleBoss\Services\User\Creator;
use SaleBoss\Services\User\CreatorListenerInterface;

class UserController extends BaseController implements CreatorListenerInterface
{

	protected   $userRepo;
	protected   $groupRepo;
	protected   $creator;

	/**
	 * @param UserRepositoryInterface $userRepo
	 * @param GroupRepositoryInterface $groupRepo
	 * @param Creator $creator
	 */
	public function __construct(
		UserRepositoryInterface $userRepo,
		GroupRepositoryInterface $groupRepo,
		Creator $creator
	){
		$this->userRepo = $userRepo;
		$this->groupRepo = $groupRepo;
		$this->creator = $creator;
	}

	/**
	 * User Dashboard page
	 *
	 * @return mixed
	 */
	public function getDash()
	{
		return $this->view('admin.pages.dashboard.main');
	}

	/**
	 * List of users
	 *
	 * @return View
	 */
	public function index()
	{
		$dynamicItems = $this->userRepo->getAllPaginated(50);
		$operationColumn = 'admin.pages.user.partials._operation';
		$columns = Config::get('dynamic_data/datatables.users');
		return $this->view(
			$this->getView(
					'admin.pages.user.index',
					'admin.pages.common.index'
			),
			compact(
				'dynamicItems',
				'operationColumn',
				'columns'
			)
		);
	}

	/**
	 * User Creation form
	 *
	 * @return \View
	 */
	public function create()
	{
		$groups = $this->groupRepo->getAll();
		$groups = $groups->lists('name','id');
		return $this->view('admin.pages.user.create',compact('groups'));
	}

	/**
	 * Edit Form for user
	 *
	 * @param $id
	 * @return View
	 */
	public function edit($id)
	{
		try {
			$groups = $this->groupRepo->getAll();
			$groups = $groups->lists('name','id');
			$user = $this->userRepo->findById($id);
			$current_groups = $this->groupRepo->getUserGroups($user);
			$current_groups = $current_groups->lists('id');
			$update = true;
			return $this->view('admin.pages.user.edit',compact('groups','user','update','current_groups'));
		}catch (NotFoundException $e){
			App::abort(404);
		}
	}

	/**
	 * Store a user in db
	 *
	 * @return Redirect
	 */
	public function store()
	{
		$input = Input::only('item');
		return $this->creator->create($input , $this);
	}


	/**
	 * What to do when creation fails
	 *
	 * @param $messages
	 * @return mixed
	 */
	public function onCreateFail($messages)
	{
		return $this->redirectBack()->withErrors($messages)->withInput();
	}

	public function onCreateSuccess($message = null)
	{
		return $this->redirectTo('users')->with(
			'success_message', ! empty($message) ? $message : Lang::get('messages.user_created')
		);
	}
}