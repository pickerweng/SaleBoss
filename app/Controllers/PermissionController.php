<?php namespace Controllers;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Lang;
use SaleBoss\Services\Permissions\Permission;
use SaleBoss\Services\Permissions\StoreListenerInterface;

class PermissionController extends BaseController implements StoreListenerInterface {

	protected $permission;

	/**
	 * @param Permission $permission
	 */
	public function __construct(
		Permission $permission
	){
		$this->permission = $permission;
        $this->beforeFilter('hasPermission:group.change_permissions',['only' => ['index','store']]);
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$this->permission->run();
		$list = $this->permission->getPermissions();
		$groups = $this->permission->getGroups();
		$defaults = $this->permission->getDefaults();
		return $this->view(
				'admin.pages.permission.index',
				compact('list','groups','defaults')
			);
	}

	/**
	 *
	 */
	public function store()
	{
		$input = Input::get('item');
		if(empty($input)){ return $this->onStoreSuccess();}

		return $this->permission->save($input,$this);
	}

	/**
	 * What to do when save fails
	 *
	 * @param $errors
	 * @return Redirect
	 */
	public function onStoreFail($errors)
	{
		return $this->redirectBack()->withErrors($errors);
	}

	/**
	 * What to do when Save succeeds
	 *
	 * @param null $message
	 * @return Redirect
	 */
	public function onStoreSuccess($message = null){
		return $this->redirectBack()->with(
				'success_message',
				empty($message) ? Lang::get('messages.operation_success') : $message
			);
	}


}
