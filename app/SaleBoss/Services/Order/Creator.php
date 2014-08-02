<?php namespace SaleBoss\Services\Order;

use Illuminate\Events\Dispatcher;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Log;
use SaleBoss\Models\Order;
use SaleBoss\Models\State;
use SaleBoss\Models\User;
use SaleBoss\Repositories\Exceptions\RepositoryException;
use SaleBoss\Repositories\OrderRepositoryInterface;
use SaleBoss\Repositories\StateRepositoryInterface;
use SaleBoss\Repositories\UserRepositoryInterface;
use SaleBoss\Services\Validator\OrderValidator;

class Creator {

	protected $orderRepo;
	protected $events;
	protected $listener;
	protected $userRepo;
    protected $orderValidator;
    protected $data;
    protected $customer;
    protected $creator;
    protected $stateRepo;
    protected $order;
    protected $accounter;

    /**
     * @param OrderRepositoryInterface $orderRepo
     * @param Dispatcher               $event
     * @param UserRepositoryInterface  $userRepo
     * @param OrderValidator           $orderValidator
     * @param StateRepositoryInterface $stateRepo
     */
    public function __construct(
		OrderRepositoryInterface $orderRepo,
		Dispatcher $event,
		UserRepositoryInterface $userRepo,
        OrderValidator $orderValidator,
        StateRepositoryInterface $stateRepo
	){
		$this->orderRepo = $orderRepo;
		$this->events = $event;
		$this->userRepo = $userRepo;
        $this->orderValidator = $orderValidator;
        $this->stateRepo = $stateRepo;
	}

    /**
     * Set listener
     *
     * @param CreatorListenerInterface $listener
     *
     * @return $this
     */
    public function setListener(CreatorListenerInterface $listener)
	{
		$this->listener = $listener;
		return $this;
	}

    /**
     * Set listener for accounter
     *
     * @param AccounterListenerInterface $listener
     *
     * @return mixed
     */
    public function setAccounterListener(AccounterListenerInterface $listener)
    {
        $this->listener = $listener;
        return $this;
    }

    /**
     * Save an order by seller
     *
     * @param $data
     * @param $customer
     * @param $creator
     *
     * @return mixed
     */
    public function sellerCreate($data, User $customer, User $creator)
	{
        try {
            $this->setData($data);
            $this->setCustomer($customer);
            $this->setCreator($creator);
            if (! $valid = $this->orderValidator->isValid($data))
            {
                return $this->listener->onCreateFail($this->orderValidator->getMessages());
            }
            $this->prepareRelation();
            $order = $this->doStore();
            $this->fireCreateEvents($order);
            return $this->listener->onCreateSuccess(Lang::get('messages.operation_success'));
        }catch (RepositoryException $e){
            Log::info($e->getMessage());
            return $this->listener->onCreateFail(Lang::get('messages.operation_error'));
        }
	}

    /**
     * Set data that class works on
     *
     * @param array $data
     *
     * @return $this
     */
    private function setData(array $data)
    {
        $this->data = $data;
        return $this;
    }

    /**
     * Set creator
     *
     * @param $creator
     *
     * @return $this
     */
    private function setCreator($creator)
    {
        $this->creator = $creator;
        return $this;
    }

    /**
     * Set Customer
     *
     * @param $customer
     *
     * @return $this
     */
    private function setCustomer($customer)
    {
        $this->customer = $customer;
        return $this;
    }

    /**
     * Add relation to data
     */
    private function prepareRelation()
    {
        $state = $this->stateRepo->findByPriority(2);
        $this->data['state_id'] = $state->id;
        $this->data['customer_id'] = $this->customer->id;
        $this->data['creator_id'] = $this->creator->id;
    }

    /**
     * Perform Store
     *
     * @return Order
     */
    private function doStore()
    {
        return $this->orderRepo->createRaw($this->data);
    }

    /**
     * @param Order $order
     * @param       $data
     */
    private function doSellerUpdate(Order $order, array $data)
    {
        return $this->orderRepo->update($order, $data);
    }

    /**
     * Fire events on order create
     *
     * @retrun void
     *
     * @param $order
     */
    private function fireCreateEvents($order)
    {
        $this->events->fire('order.updated',array($order));
        $this->events->fire('order.created',array($order));
        $this->events->fire('order.created_by_saler',array($order));
    }

	/**
	 * Approve Accounting job
	 *
	 * @param Order $order
	 * @param User $accounter
	 * @param array $data
	 * @return AccounterListenerInterface
	 */
    public function accounterApprove(Order $order, User $accounter,array $data)
    {
        $this->setOrder($order);
        $this->setAccounter($accounter);
        $this->setData($data);
        try {
            return $this->doAccounterApprove();
        }catch(InvalidStateException $e){
            return $this->listener->onInvalidState(
                "سفارش در مرحله حسابداری قرار ندارد"
            );
        }
    }

    /**
     * Set order that is currently we are working on
     *
     * @param Order $order
     *
     * @return $this
     */
    public function setOrder(Order $order)
    {
        $this->order = $order;
        return $this;
    }

    /**
     * Set accounter that currently works on order
     *
     * @param User $accounter
     *
     * @return $this
     */
    public function setAccounter(User $accounter)
    {
        $this->accounter = $accounter;
        return $this;
    }

	/**
	 * Do Accounter Approve or Deport
	 *
	 * @throws InvalidStateException
	 * @return Model
	 */
    private function doAccounterApprove()
    {
        $data = [];
        if(! empty($this->data['description']))
        {
            $data['description'] = $this->data['description'];
        }
        $data['accounter_approved'] = empty($this->data['accounter_approved']) ? false : true;

	    $currentStep = $this->getCurrentStep();
	    if (is_null($currentStep))
	    {
		    throw new InvalidStateException("Order is not in your state");
	    }
	    if ($currentStep->priority != 2)
	    {
		    throw new InvalidStateException("Order is not in your state");
	    }

	    if ($data['accounter_approved'])
	    {
		    $nextStep = $this->getNextStep($currentStep);
	    }else
	    {
			$nextStep = $this->getPreviousStep($currentStep);
	    }
        if (!is_null($nextStep)) $data['state_id'] = $nextStep->id;

	    $order = $this->orderRepo->update($this->order, $data);

	    $this->fireAccounterApproveEvents($data['accounter_approved'], [$order]);

	    if ($data['accounter_approved'])
	    {
		    return $this->listener->onApproveSuccess(Lang::get('messages.operation_success'));
	    }
	    return $this->listener->onDeport(Lang::get('messages.operation_error'));
    }

	/**
	 * Fire events when accounts are approved
	 *
	 * @param $approved
	 * @param $data
	 * @return void
	 */
	private  function fireAccounterApproveEvents($approved, array $data)
    {
	    if ($approved)
	    {
		    $this->events->fire('order.accounter_approved',$data);
	    } else
	    {
		    $this->events->fire('order.accounter_deported',$data);
	    }
        $this->events->fire('order.updated',$data);
        $this->events->fire('order.changed_state',$data);
    }

	/**
	 * Get next order step from current orderd id
	 *
	 * @param State $state
	 * @return mixed|\SaleBoss\Models\State
	 */
	private function getNextStep(State $state = null)
    {
	    if (is_null($state)) return null;
        $nextStep = $this->stateRepo->findNextByPriority($state->priority);
        return $nextStep;
    }

	/**
	 * Get current state of the order
	 *
	 * @return \SaleBoss\Models\State
	 */
	private function getCurrentStep()
	{
		$currentStep = $this->stateRepo->findById($this->order->state_id);
		return $currentStep;
	}

	/**
	 * Get previous step of order
	 *
	 * @param State $state
	 * @return null
	 */
	private function getPreviousStep(State $state = null)
	{
		if(is_null($state)) return null;
		$previousStep = $this->stateRepo->findPreviousByPriority($state->priority);
		return $previousStep;
	}

    public function sellerUpdate (Order $order, User $updater, $data)
    {
        try {
            $this->setData($data);
            $this->updater = $updater;
            if (! $valid = $this->orderValidator->isValid($data))
            {
                return $this->listener->onCreateFail($this->orderValidator->getMessages());
            }
            /*if ($order->accounter_approved){
                $state = $this->stateRepo->findByPriority(3);
            }else {
                $state = $this->stateRepo->findByPriority(2);
            }*/
			$state = $this->stateRepo->findByPriority(2);
            $this->data['state_id'] = $state->id;
            $order = $this->doSellerUpdate($order, $this->data);
            $this->fireUpdateEvents($order);
            return $this->listener->onCreateSuccess(Lang::get('messages.operation_success'));
        }catch (RepositoryException $e){
            Log::info($e->getMessage());
            return $this->listener->onCreateFail(Lang::get('messages.operation_error'));
        }
    }

    private function fireUpdateEvents($order)
    {
        $this->events->fire('order.updated',array($order));
        $this->events->fire('order.updated_by_saler',array($order));
    }

}