<?php namespace SaleBoss\Services\Stats\Commands;

use Laracasts\Commander\CommandHandler;
use SaleBoss\Repositories\LeadRepositoryInterface;
use SaleBoss\Repositories\OrderRepositoryInterface;
use SaleBoss\Repositories\UserRepositoryInterface;
use SaleBoss\Services\Date\Exceptions\InvalidArgumentException;
use SaleBoss\Services\Date\JalaliDateRange;

class UserStatsCommandHandler implements CommandHandler
{

    public $command;
    protected $userRepo;
    protected $leadRepo;
    protected $orderRepo;
    public $user;
    public $dataObject;

    public function __construct(
        UserRepositoryInterface $userRepo,
        OrderRepositoryInterface $orderRepo,
        LeadRepositoryInterface $leadRepo,
        JalaliDateRange $dateRange
    )
    {
        $this->userRepo = $userRepo;
        $this->orderRepo = $orderRepo;
        $this->leadRepo = $leadRepo;
        $this->dateRange = $dateRange;

        $this->dataObject = new \StdClass();
    }

    public function handle($command)
    {
        $this->command = $command;
        $this->resolveDateRange();
        $this->user = $this->getUser();

        $this->totalOrders();

        $this->totalCustomers();

        $this->totalLeads();

        $this->totalUndefinedList();

        $this->totalSuccessfulLeads();

        $this->totalUnsuccessfulLeads();

        $this->totalPendingLeads();

        $this->generalPanelOrders();

        $this->exprimentalPanels();

        $this->freePanels();

        $this->couponPanels();

        $this->panelLess();

        $this->hasPanels();

        $this->completedOrders();

        $this->fromLeadsCustomers();

        $this->totalPanelPrice();

        $this->leadedOrderStats();

        $this->scoreList();

        return $this->dataObject;
    }

    protected function getUser()
    {
        return $this->command->user;
    }

    protected function resolveDateRange()
    {
        try {
            $this->command->start = $this->dateRange->getDayBeginStringOf($this->command->start);
            $this->command->end = $this->dateRange->getDayEndStringOf($this->command->end);
        } catch (InvalidArgumentException $e) {
            $this->command->start = null;
            $this->command->end = null;
        }
    }

    private function totalOrders()
    {
        $this->dataObject->totalOrders = $this->orderRepo->countWithQuery(
            $this->command->start,
            $this->command->end,
            ['creator_id' => $this->user->id]
        );
    }

    private function totalCustomers()
    {
        $this->dataObject->totalCustomers = $this->userRepo->countAllCustomers(
            $this->command->start,
            $this->command->end,
            ['creator_id' => $this->user->id]
        );
    }

    private function totalLeads()
    {
        $this->dataObject->totalLeads = $this->leadRepo->countWithQuery(
            $this->command->start,
            $this->command->end,
            ['creator_id' => $this->user->id]
        );
    }

    private function totalUndefinedList()
    {
        $this->dataObject->totalUndefinedLeads = $this->leadRepo->countWithQuery(
            $this->command->start,
            $this->command->end,
            ['creator_id' => $this->user->id, 'status' => 0]
        );
    }

    private function totalSuccessfulLeads()
    {
        $this->dataObject->totalSuccessfulLeads = $this->leadRepo->countWithQuery(
            $this->command->start,
            $this->command->end,
            ['creator_id' => $this->user->id, 'status' => 1]
        );
    }

    private function totalUnsuccessfulLeads()
    {
        $this->dataObject->totalUnsuccessfulLeads = $this->leadRepo->countWithQuery(
            $this->command->start,
            $this->command->end,
            ['creator_id' => $this->user->id, 'status' => -1]
        );
    }

    private function totalPendingLeads()
    {
        $this->dataObject->totalPendingLeads = $this->leadRepo->countWithQuery(
            $this->command->start,
            $this->command->end,
            ['creator_id' => $this->user->id, 'status' => 2]
        );
    }

    private function generalPanelOrders()
    {
        $this->dataObject->generalPanelOrders = $this->orderRepo->countWithQuery(
            $this->command->start,
            $this->command->end,
            ['creator_id' => $this->user->id, 'panel_type' => 0]
        );
    }

    private function exprimentalPanels()
    {
        $this->dataObject->exprimentalPanels = $this->orderRepo->countWithQuery(
            $this->command->start,
            $this->command->end,
            ['creator_id' => $this->user->id, 'panel_type' => 2]
        );
    }

    private function freePanels()
    {
        $this->dataObject->freePanels = $this->orderRepo->countWithQuery(
            $this->command->start,
            $this->command->end,
            ['creator_id' => $this->user->id, 'panel_type' => 3]
        );
    }

    private function couponPanels()
    {
        $this->dataObject->couponPanels = $this->orderRepo->countWithQuery(
            $this->command->start,
            $this->command->end,
            ['creator_id' => $this->user->id, 'panel_type' => 1]
        );
    }

    private function panelLess()
    {
        $this->dataObject->panelLess = $this->orderRepo->countWithQuery(
            $this->command->start,
            $this->command->end,
            ['creator_id' => $this->user->id, 'panel_type' => 4]
        );
    }

    private function hasPanels()
    {
        $this->dataObject->hasPanels = $this->orderRepo->countWithQuery(
            $this->command->start,
            $this->command->end,
            ['creator_id' => $this->user->id, 'panel_type' => 5]
        );
    }

    private function completedOrders()
    {
        $this->dataObject->completedOrders = $this->orderRepo->countWithQuery(
            $this->command->start,
            $this->command->end,
            ['creator_id' => $this->user->id, 'completed' => true]
        );
    }

    private function fromLeadsCustomers()
    {
        $this->dataObject->fromLeadCustomers = $this->userRepo->countWithLead(
            $this->command->start,
            $this->command->end,
            ['creator_id' => $this->user->id]
        );
    }

    private function totalPanelPrice()
    {
        $this->dataObject->totalPanelPrice = $this->orderRepo->sumPanelPrice(
            $this->command->start,
            $this->command->end,
            ['creator_id' => $this->user->id]
        );
    }

    private function scoreList()
    {
        $this->dataObject->scoreList = $this->orderRepo->getScoreList($this->command->start, $this->command->end);
    }

    private function leadedOrderStats()
    {
        $this->dataObject->leadedOrderStats = $this->orderRepo->leadedOrdersStats(
            $this->command->start,
            $this->command->end,
            ['creator_id' => $this->user->id]
        );
        dd($this->dataObject->leadedOrderStats);
    }
} 
