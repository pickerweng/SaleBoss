<?php namespace SaleBoss\Events;

use Illuminate\Events\Dispatcher;
use SaleBoss\Repositories\GroupRepositoryInterface;

class Customer {
    protected $events;

    public function __construct(
        Dispatcher $events,
        GroupRepositoryInterface $groupRepo
    ){
        $this->events = $events;
        $this->groupRepo = $groupRepo;
    }

    public function whenCustomerHasBeenCreated($customer)
    {
        $this->groupRepo->addGroupsToUser($customer,['customer'],'name');
    }
}