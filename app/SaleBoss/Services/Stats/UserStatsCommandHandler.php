<?php namespace SaleBoss\Services\Stats; 

use Laracasts\Commander\CommandHandler;
use SaleBoss\Repositories\LeadRepositoryInterface;
use SaleBoss\Repositories\OrderRepositoryInterface;
use SaleBoss\Repositories\UserRepositoryInterface;

class UserStatsCommandHandler implements CommandHandler
{

    public $command;
    public $userRepo;
    public $leadRepo;
    public $orderRepo;
    public $user;
    public $dataObject;

    public function __construct(
        UserRepositoryInterface $userRepo,
        OrderRepositoryInterface $orderRepo,
        LeadRepositoryInterface $leadRepo
    ){
        $this->userRepo = $userRepo;
        $this->orderRepo = $orderRepo;
        $this->leadRepo = $leadRepo;
        $this->dataObject = new \StdClass();
    }

    public function handle($command)
    {
        $this->command = $command;
        $this->user = $this->getUser();

        $this->dataObject->totalOrders = $this->orderRepo->countWithQuery(
            $this->command->start,
            $this->command->end,
            ['creator_id' => $this->user->id]
        );

        $this->dataObject->totalCustomers = $this->userRepo->countAllCustomers(
            $this->command->start,
            $this->command->end,
            ['creator_id' => $this->user->id]
        );

        $this->dataObject->totalLeads = $this->leadRepo->countWithQuery(
            $this->command->start,
            $this->command->end,
            ['creator_id' => $this->user->id]
        );

        $this->dataObject->totalUndefinedLeads = $this->leadRepo->countWithQuery(
            $this->command->start,
            $this->command->end,
            ['creator_id' => $this->user->id, 'status' => 0]
        );

        $this->dataObject->totalSuccessfulLeads = $this->leadRepo->countWithQuery(
            $this->command->start,
            $this->command->end,
            ['creator_id' => $this->user->id, 'status' => 1]
        );

        $this->dataObject->totalUnsuccessfulLeads = $this->leadRepo->countWithQuery(
            $this->command->start,
            $this->command->end,
            ['creator_id' => $this->user->id, 'status'  => -1]
        );

        $this->dataObject->totalPendingLeads = $this->leadRepo->countWithQuery(
            $this->command->start,
            $this->command->end,
            ['creator_id' => $this->user->id, 'status' => 2]
        );

        $this->dataObject->generalPanelOrders = $this->orderRepo->countWithQuery(
            $this->command->start,
            $this->command->end,
            ['creator_id' => $this->user->id, 'panel_type'  =>  0]
        );

        $this->dataObject->exprimentalPanels = $this->orderRepo->countWithQuery(
            $this->command->start,
            $this->command->end,
            ['creator_id' => $thi->user->id, 'panel_type' => 1]
        );

        
        $totalUnsuccessfulLeads = $this->leadRepo->countWithQuery($before, ['status' => -1, 'creator_id' => $user->id]);

        return $this->dataObject;
    }

    protected function getUser()
    {
        return $this->userRepo->findById($this->command->userId);
    }
} 
