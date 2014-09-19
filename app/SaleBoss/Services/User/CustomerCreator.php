<?php namespace SaleBoss\Services\User;


use Illuminate\Events\Dispatcher;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Log;
use SaleBoss\Models\User;
use SaleBoss\Repositories\Exceptions\NotFoundException;
use SaleBoss\Repositories\Exceptions\RepositoryException;
use SaleBoss\Repositories\LeadRepositoryInterface;
use SaleBoss\Repositories\UserRepositoryInterface;
use SaleBoss\Services\Authenticator\AuthenticatorInterface;
use SaleBoss\Services\Validator\CustomerCreationValidator;

class CustomerCreator {

    protected $userRepo;
    protected $listener;
    protected $validator;
    protected $event;
    protected $auth;
    protected $updateListener;
    protected $customer;
    protected $leadRepo;

    /**
     * @param UserRepositoryInterface $userRepo
     * @param CustomerCreationValidator $validator
     * @param LeadRepositoryInterface $leadRepo
     * @param Dispatcher $event
     * @param AuthenticatorInterface $auth
     */
    public function __construct(
        UserRepositoryInterface $userRepo,
        CustomerCreationValidator $validator,
        LeadRepositoryInterface $leadRepo,
        Dispatcher $event,
        AuthenticatorInterface $auth
    ){
        $this->userRepo = $userRepo;
        $this->validator = $validator;
        $this->leadRepo = $leadRepo;
        $this->events = $event;
        $this->auth = $auth;
    }

    /**
     * Set Listener to decide what to when in different situations
     * @param CustomerCreatorListenerInterface $listener
     *
     * @return $this
     */
    public function setListener(CustomerCreatorListenerInterface $listener)
    {
        $this->listener = $listener;
        return $this;
    }

    /**
     * Set Listener to decide what to when in different situations
     * @param CustomerUpdaterListenerInterface $listener
     *
     * @return $this
     */
    public function setUpdateListener(CustomerUpdaterListenerInterface $listener)
    {
        $this->updateListener = $listener;
        return $this;
    }

    /**
     * Proccess Customer Creation
     *
     * @param $data
     *
     * @return
     */
    public function create($data)
    {
        $this->setData($data);
        if (!$valid = $this->validator->isValid($this->data))
        {
            return $this->listener->onStoreFail($this->validator->getMessages());
        }

        try
        {
            if (!empty ($this->data['lead_id'])){
                $lead = $this->leadRepo->findById($this->data['lead_id']);
                if ($lead->creator_id != $this->auth->user()->id && $this->auth->user()->hasAnyAccess(['create_user_for_lead']) )
                {
                    App::abort(404);
                }
            }else {
	            $this->data['lead_id'] = null;
            }
            $customer = $this->doStore();
            return $this->listener->onStoreSuccess(Lang::get('messages.operation_success'),$customer);
        }catch ( RepositoryException $e)
        {
            Log::info($e->getMessage());
            return $this->listener->onStoreFail([Lang::get('messages.operation_error')]);
        }
    }

    /**
     * Set the data that the crerator class is working on it
     *
     * @param $data
     */
    protected function setData($data)
    {
        $this->data = $data;
    }

    /**
     * Process DB storing
     *
     * @return null
     */
    protected function doStore()
    {
        $this->data['is_customer'] = true;
        $this->data['password'] = $this->data['email'];
        $this->data['creator_id'] = $this->auth->user()->id;
        $customer = $this->userRepo->createRaw($this->data);
        $this->events->fire('customer.created',array($customer));
        return $customer;
    }

    /**
     * Porcess Update
     *
     * @param $customer
     * @param $data
     *
     * @return void
     */
    public function update($customer, $data)
    {
        $this->setCustomer($customer);
        $this->setData($data);
        $this->validator->setCurrentIdFor('email',$customer->id);
	    $this->validator->setCurrentIdFor('mobile',$customer->id);
	    $this->validator->setCurrentIdFor('tell',$customer->id);
        if (! $valid = $this->validator->isValid($data))
        {
            return $this->updateListener->onUpdateFail($this->validator->getMessages());
        }
        try
        {
            $this->doUpdate();
            return $this->updateListener->onUpdateSuccess();
        }catch (NotFoundException $e)
        {
            return $this->updateListener->onUpdateFail([Lang::get('messages.operation_error')]);
        }
    }

    /**
     * Process update
     *
     * @return void
     */
    protected function doUpdate()
    {
        $this->userRepo->rawUpdate($this->customer, $this->data);
    }

    /**
     * Set update customer
     *
     * @param User $customer
     *
     * @return $this
     */
    protected function setCustomer(User $customer)
    {
        $this->customer = $customer;
        return $this;
    }
}
