<?php

namespace Controllers\Opilo;

use Controllers\BaseController;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Input;
use SaleBoss\OpiloOrders\OrderCreator;
use SaleBoss\OpiloOrders\OrderCreatorListenerInterface;
use SaleBoss\Repositories\Exceptions\NotFoundException;
use SaleBoss\Repositories\UserRepositoryInterface;
use SaleBoss\Services\Authenticator\AuthenticatorInterface;
use SaleBoss\Services\EavSmartAss\EavManagerInterface;
use SaleBoss\Services\EavSmartAss\Form\FormOptionProvider;
use SaleBoss\Services\Order\Creator;

class OrderController extends BaseController{

	protected $orderCreator;
	protected $userRepo;
	protected $auth;


	/**
	 * @param Creator $creator
	 * @param UserRepositoryInterface $userRepo
	 * @param AuthenticatorInterface $auth
	 */
	public function __construct(
		Creator $creator,
		UserRepositoryInterface $userRepo,
		AuthenticatorInterface $auth
	){
		$this->orderCreator = $creator;
		$this->userRepo = $userRepo;
		$this->auth = $auth;
	}

	public function create($id)
	{
		try {
			$customer = $this->userRepo->findCustomer($id);
			$authUser = $this->auth->user();
			if (! $this->createPermCallback($customer))
			{
				return $this->redirectTo('dash')->with(
					'error_message',
					'شما اجاز دسترسی به صفحه مورد نظر را ندارید.'
				);
			}
			$title = "ایجاد سفارش جدید برای {$customer->name()}";
			$opiloConfig = Config::get('opilo_configs');
			$description = "سفارش در حال ایجاد شدن توسط {$authUser->getIdentifier()}";
			return $this->view(
				'admin.pages.order.create',
				compact('customer','authUser','title','description','opiloConfig')
			);
		}catch (NotFoundException $e){
			App::abort(404);
		}
	}

	/**
	 * Access callback for creating an order
	 *
	 * @param $customer
	 * @return bool
	 */
	protected function createPermCallback($customer)
	{
		$create_own = $this->auth->user()->hasAnyAccess(['orders.own_create']);
		$create = $this->auth->user()->hasAnyAccess(['orders.create']);
		$creator_id = $customer->creator_id;
		$current_id = $this->auth->user()->id;

		if ($create_own && ($creator_id == $current_id)) return true;
		if ($create) return true;
		if (is_null($creator_id) && $create_own) return true;
		return false;
	}


	/**
	 * What to do when an order fails to be saved
	 *
	 * @param $messages
	 * @return mixed
	 */
	public function onCreateFail($messages)
	{
		return $this->redirectBack()->withErrors($messages);
	}

	/**
	 * What do when an order is created
	 *
	 * @param $message
	 * @return mixed
	 */
	public function onCreateSuccess($message)
	{
		return $this->redirectTo('opilo-orders/create')->with('success_message',$message);
	}
}