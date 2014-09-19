<?php namespace Controllers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Lang;
use SaleBoss\Repositories\Exceptions\InvalidArgumentException;
use SaleBoss\Repositories\Exceptions\NotFoundException;
use SaleBoss\Repositories\StateRepositoryInterface;
use SaleBoss\Services\Validator\StateValidator;

class StateController extends BaseController{

	protected $stateRepo;
	protected $sValidator;

	/**
	 * @param StateRepositoryInterface $stateRepo
	 * @param StateValidator $sValidator
	 */
	public function __construct(
		StateRepositoryInterface $stateRepo,
		StateValidator $sValidator
	){
		$this->stateRepo  = $stateRepo;
		$this->sValidator = $sValidator;
        $this->beforeFilter('hasPermission:states');
	}

	/**
	 * Listing available states
	 *
	 * @return View
	 */
	public function index()
	{
		$states = $this->stateRepo->getAllSorted('priority');
		return $this->view(
			'admin.pages.state.index',
			compact('states')
		);
	}

	/**
	 * Creation form for state
	 *
	 * @return View
	 */
	public function create()
	{
		return $this->view(
			'admin.pages.state.create'
		);
	}

	/**
	 * Storing an State in DB
	 *
	 * @return Redirect
	 */
	public function store()
	{
		$input = Input::get('item');
		$valid = $this->sValidator->isValid($input);
		if (!$valid)
		{
			return $this->redirectBack()->withErrors($this->sValidator->getMessages());
		}
		try {
			$this->stateRepo->create($input);
			return $this->redirectBack()->with('success_message',Lang::get('messages.operation_success'));
		}catch( InvalidArgumentException $e){
			$this->redirectBack()->with('error_message',Lang::get('messages.operation_error'));
		}
	}

	/**
	 * Edit form for editing an State when an id is provided
	 *
	 * @param $id
	 * @return View
	 */
	public function edit($id)
	{
		$update = true;
		try {
			$state = $this->stateRepo->findById($id);
			return $this->view(
				'admin.pages.state.edit',
				compact('update','state')
			);
		}catch(NotFoundException $e){
			App::abort(404);
		}
	}

	/**
	 * Update a user in DB when an id is provided
	 *
	 * @param $id
	 * @return Redirect
	 */
	public function update($id)
	{
		try {
			$input = Input::get('item');
			$this->sValidator->setCurrentIdFor('title',$id);
			$valid = $this->sValidator->isValid($input);
			$this->sValidator->setCurrentIdFor('title',$id);
			if (!$valid)
			{
				return $this->redirectBack()->withErrors($this->sValidator->getMessages());
			}
			$this->stateRepo->update($id,$input);
			return $this->redirectBack()->with('success_message',Lang::get('messages.operation_success'));
		}catch (NotFoundException $e){
			App::abort(404);
		} catch (InvalidArgumentException $e){
			return $this->redirectBack()->with('error_message',Lang::get('messages.operation_error'));
		}
	}

	/**
	 * Delete an state from db
	 *
	 * @param $id
	 * @return Redirect
	 */
	public function destroy($id)
	{
		try {
			$this->stateRepo->delete($id);
			return $this->redirectTo('states')
						->with(
							'success_message',
							Lang::get('messages.operation_success')
						);
		}catch (NotFoundException $e){
			App::abort(404);
		}
	}

} 