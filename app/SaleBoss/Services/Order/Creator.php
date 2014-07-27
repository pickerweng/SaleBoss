<?php namespace SaleBoss\Services\Order;

use Illuminate\Events\Dispatcher;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Log;
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
     */public function setListener(CreatorListenerInterface $listener)
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

}