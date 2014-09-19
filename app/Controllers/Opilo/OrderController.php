<?php

namespace Controllers\Opilo;

use Controllers\BaseController;
use Illuminate\Events\Dispatcher;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Lang;
use SaleBoss\Repositories\Exceptions\NotFoundException;
use SaleBoss\Repositories\OrderLogRepositoryInterface;
use SaleBoss\Repositories\OrderRepositoryInterface;
use SaleBoss\Repositories\StateRepositoryInterface;
use SaleBoss\Repositories\UserRepositoryInterface;
use SaleBoss\Services\Authenticator\AuthenticatorInterface;
use SaleBoss\Services\Order\AccounterListenerInterface;
use SaleBoss\Services\Order\Creator;
use SaleBoss\Services\Order\CreatorListenerInterface;

class OrderController extends BaseController
	implements CreatorListenerInterface, AccounterListenerInterface
{

	protected $orderCreator;
	protected $userRepo;
	protected $auth;
    protected $orderLogRepo;

    /**
     * @param Creator                                            $creator
     * @param UserRepositoryInterface                            $userRepo
     * @param AuthenticatorInterface                             $auth
     * @param OrderRepositoryInterface                           $orderRepo
     * @param Dispatcher                                         $events
     * @param \SaleBoss\Repositories\StateRepositoryInterface    $stateRepo
     * @param \SaleBoss\Repositories\OrderLogRepositoryInterface $orderLogRepo
     */
	public function __construct(
		Creator $creator,
		UserRepositoryInterface $userRepo,
		AuthenticatorInterface $auth,
		OrderRepositoryInterface $orderRepo,
		Dispatcher $events,
		StateRepositoryInterface $stateRepo,
        OrderLogRepositoryInterface $orderLogRepo
	)
	{
		$this->orderCreator = $creator;
		$this->userRepo = $userRepo;
		$this->orderRepo = $orderRepo;
		$this->auth = $auth;
		$this->events = $events;
		$this->stateRepo = $stateRepo;
        $this->orderLogRepo = $orderLogRepo;
		$this->beforeFilter('hasPermission:orders.accounter_approve', ['only' => 'accounterUpdate']);
        $this->beforeFilter('hasPermission:orders.suspend', ['only' => 'suspendUpdate']);
        $this->beforeFilter('hasPermission:orders.supporter_approve', ['only' => 'supporterUpdate']);
	}

	public function create($id)
	{
		try {
			$customer = $this->userRepo->findCustomer($id);
			$authUser = $this->auth->user();
			if (!$this->createPermCallback($customer)) {
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
				compact('customer', 'authUser', 'title', 'description', 'opiloConfig')
			);
		} catch (NotFoundException $e) {
			App::abort(404);
		}
	}

	/**
	 * Store an order into database
	 *
	 * @param $customerId
	 */
	public function store($customerId)
	{
		try {
			$data = Input::only(
				"panel_type",
				"panel_type",
				"private_number",
				"sms_price",
				"sms_text",
				"sms_quantity",
				"sms_description",
				"payment_type",
				"cart_number",
				"panel_price",
				"description"
			);
			$creator = $this->auth->user();
			$customer = $this->userRepo->findCustomer($customerId);
			$this->orderCreator->setListener($this);
			return $this->orderCreator->sellerCreate($data, $customer, $creator);
		} catch (NotFoundException $e) {
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
		return $this->redirectBack()->withErrors($messages)->withInput();
	}

	/**
	 * What do when an order is created
	 *
	 * @param $message
	 * @return mixed
	 */
	public function onCreateSuccess($message = null)
	{
		return $this->redirectTo('my/orders')->with('success_message', $message);
	}

	public function myIndex()
	{
		$title = 'لیست سفارش های من';
		$description = 'لیست سفارش هایی که من ایجاد کرده ام';
		// $generatedOrders = $this->orderRepo->getGeneratedOrders($this->auth->user(), 50);
		$generatedOrders = $this->orderRepo->getSearchableCreatorOrders($this->auth->user(),50);
        $states = ['' => 'همه'] + $this->stateRepo->getAll()->lists('title','id');
        $inMyOrders = true;
		return $this->view(
			'admin.pages.order.my_index',
			compact('title', 'description', 'generatedOrders', 'inMyOrders','states')
		);
	}

	/**
	 * Showing a customer
	 *
	 * @param $id
	 * @return View
	 */
	public function show($id)
	{
		try {
			$order = $this->orderRepo->findById($id);
			$title = "مشاهده سفارش {$order->id}";
			$description = "این سفارش توسط{$order->creator()->first()->getIdentifier()} ایجاد شده است. ";
			$customer = $order->customer()->first();
            $currentUser = $this->auth->user();
            if ($customer->crator_id != $currentUser->id && ! $currentUser->hasAnyAccess(['orders.view']))
            {
                return $this->redirectTo('dash')->with('error_message',Lang::get("messages.permission_denied"));
            }
            $lastEdited = $this->orderLogRepo->findLastLogFor($order);
			$opiloConfig = Config::get('opilo_configs');
			return $this->view(
				'admin.pages.order.show',
				compact('customer', 'title', 'description', 'order', 'opiloConfig','lastEdited')
			);
		} catch (NotFoundException $e) {
			App::abort(404);
		}
	}

	/**
	 * List all orders
	 *
	 * @return View
	 */
	public function index()
	{
		$title = 'لیست همه سفارش ها';
		$description = 'سفارش هایی که توسط کاربران ایجاد شده است.';
		$states = $this->stateRepo->getAll();
        $states = ['' => 'همه'] + $states ->lists('title','id');
		if (!$this->auth->user()->hasAnyAccess(['orders.view_all'])) {
			return $this->redirectTo('my/orders');
		}
		// $generatedOrders = $this->orderRepo->getGeneratedOrders(null, 50);
        $generatedOrders = $this->orderRepo->getSearchableOrders(25);
		return $this->view(
			'admin.pages.order.index',
			compact('title', 'description','states', 'generatedOrders','state')
		);
	}


	/**
	 * Update for accounter
	 *
	 * @param $id
	 */
	public function accounterUpdate($id)
	{
		try {
			$accounter = $this->auth->user();
			$order = $this->orderRepo->findById($id);
			$input = Input::only(
				'description',
				'accounter_approved'
			);
			$this->orderCreator->setAccounterListener($this);
			return $this->orderCreator->accounterApprove($order, $accounter, $input);
		} catch (NotFoundExcption $e) {
			App::abort(404);
		}
	}

	/**
	 * What to do when order status is not valid
	 *
	 * @param $message
	 *
	 * @return mixed
	 */
	public function onInvalidState($message)
	{
		return $this->redirectTo('dash')->with('error_message', $message);
	}

	/**
	 * What to do when Approve success
	 *
	 * @param $message
	 *
	 * @return mixed
	 */
	public function onApproveSuccess($message)
	{
		return $this->redirectBack()->with('success_message', Lang::get('messages.operation_success'));
	}

	/**
	 * What to when order deports
	 *
	 * @param $message
	 *
	 * @return mixed
	 */
	public function onDeport($message)
	{
		return $this->redirectBack()->with('success_message', 'سفارش به مرحله ی قبل فرستاده شد.');
	}

	/**
	 * @param $id
	 */
	public function suspendUpdate($id)
	{
		try {
			$order = $this->orderRepo->findById($id);
			$input = Input::only('suspended');
            if ($input['suspended'])
            {
                $input['completed'] = false;
            }
			$this->events->fire('orders.updated', array($order));
			$this->orderRepo->update($order, $input);
			return $this->redirectBack()->with('success_message', Lang::get('messages.operation_success'));
		} catch (NotFoundException $e) {
			App::abort(404);
		}

	}

	/**
	 * Supporter update
	 */
	public function supporterUpdate($id)
	{
		try {
			$input = Input::only('completed', 'description');
            $to_accounter = Input::get('to_accounter');
			$order = $this->orderRepo->findById($id);
			$current_state = $this->stateRepo->findById($order->state_id);
			if ($current_state->priority != 3) {
				return $this->redirectBack()->with('error_message', 'سفارش در صف پشتیبانی نمیباشد.');
			}
			if ($input['completed']) {
                $input['suspended'] = false;
				$order = $this->orderRepo->update($order, $input);
			} else {
                if (!empty($to_accounter))
                {
                    $state = $this->stateRepo->findByPriority(2);
                }else
                {
                    $state = $this->stateRepo->findByPriority(1);
                }
				$input['state_id'] = $state->priority;
				$order = $this->orderRepo->update($order, $input);
			}
			$this->events->fire('order.updated', array($order));
			return $this->redirectBack()->with('success_message', Lang::get('messages.operation_success'));
		} catch (NotFoundException $e) {
			App::abort(404);
		}
	}

	public function edit($id)
	{
		try {
            $order = $this->orderRepo->findById($id);
            $sellerState = $this->stateRepo->findByPriority(1);
            $currentUser= $this->auth->user();
            if ($currentUser->id != $order->creator_id && ! $currentUser->hasAnyAccess(['orders.edit']))
            {
                return $this->redirectBack()->with('error_message',Lang::get("messages.permission_denied"));
            }
            if ($sellerState->id != $order->state_id)
            {
                return $this->redirectTo('my/orders')->with('error_message',Lang::get("messages.invalid_state"));
            }
            $lastEdited = $this->orderLogRepo->findLastLogFor($order);
            $customer = $order->customer;
            return $this->view(
                "admin.pages.order.edit",
                compact('order','sellerState','currentUser','lastEdited','customer')
            );
        }catch (NotFoundException $e){
            App::abort(404);
        }
	}

    public function update($id)
    {
        try {
            $order = $this->orderRepo->findById($id);
            $sellerState = $this->stateRepo->findByPriority(1);
            $currentUser = $this->auth->user();
            if ($currentUser->id != $order->creator_id && ! $currentUser->hasAnyAccess(['orders.edit']))
            {
                return $this->redirectBack()->with('error_message',Lang::get("messages.permission_denied"));
            }
            if ($sellerState->id != $order->state_id)
            {
                return $this->redirectTo('my/orders')->with('error_message',Lang::get("messages.invalid_state"));
            }
            $data = Input::only(
                "panel_type",
                "panel_type",
                "private_number",
                "sms_price",
                "sms_text",
                "sms_description",
				"sms_quantity",
                "payment_type",
                "cart_number",
                "panel_price",
                "description"
            );
            $this->orderCreator->setListener($this);
            return $this->orderCreator->sellerUpdate($order, $currentUser, $data);
        }catch (NotFoundException $e){
            App::abort(404);
        }
    }

}