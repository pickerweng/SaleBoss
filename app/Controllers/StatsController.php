<?php namespace Controllers; 

use Carbon\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Input;
use SaleBoss\Repositories\Exceptions\NotFoundException;
use SaleBoss\Repositories\LeadRepositoryInterface;
use SaleBoss\Repositories\OrderRepositoryInterface;
use SaleBoss\Repositories\UserRepositoryInterface;
use SaleBoss\Services\Authenticator\AuthenticatorInterface;
use SaleBoss\Services\Stats\Commands\UserStatsCommand;
use SaleBoss\Services\User\Commands\GetUserCommand;

class StatsController extends BaseController
{

    protected $orderRepo;
    protected $userRepo;
    protected $leadRepo;
    protected $auth;

    public function __construct(
        OrderRepositoryInterface $orderRepo,
        UserRepositoryInterface $userRepo,
        LeadRepositoryInterface $leadRepo,
        AuthenticatorInterface $auth
    ){
        $this->orderRepo = $orderRepo;
        $this->userRepo = $userRepo;
        $this->leadRepo = $leadRepo;
        $this->auth = $auth;
    }

    public function whole(){
        $before = Input::get('period');
        if (!empty($before))
        {
            $before = Carbon::createFromTimestamp(strtotime('tomorrow') - ((int) $before * 24 * 60 * 60))->toDateTimeString();
        }
        $totalOrders = $this->orderRepo->countAll($before);
        $totalCustomers = $this->userRepo->countAllCustomers($before);
        $totalLeads = $this->leadRepo->countAll($before);
        $totalSystemUsers = $this->userRepo->countAllUsers($before);
        $totalUndefinedLeads = $this->leadRepo->countWithQuery($before,['status' => 0]);
        $totalSuccessfulLeads = $this->leadRepo->countWithQuery($before, ['status' => 1]);
        $totalUnsuccessfulLeads = $this->leadRepo->countWithQuery($before, ['status' => -1]);
        $totalPendingLeads = $this->leadRepo->countWithQuery($before, ['status' => 2]);
        $generalPanelOrders = $this->orderRepo->countWithQuery($before, ['panel_type' => 0]);
        $experimentalPanels = $this->orderRepo->countWithQuery($before, ['panel_type' => 2]);
        $freePanels = $this->orderRepo->countWithQuery($before,['panel_type' => 1]);
        $couponPanels = $this->orderRepo->countWithQuery($before, ['panel_type' => 3]);
        $panelLess = $this->orderRepo->countWithQuery($before, ['panel_type' => 4]);
        $hasPanels = $this->orderRepo->countWithQuery($before, ['panel_type' => 5]);
        $completedOrders = $this->orderRepo->countWithQuery($before , ['completed' => 1]);
        $fromLeadCustomers = $this->userRepo->countWithLead($before);
        $totalPanelPrice = $this->orderRepo->sumPanelPrice($before);
        return $this->view('admin.pages.stat.whole',compact(
            'totalOrders',
            'totalLeads',
            'totalSystemUsers',
            'totalCustomers',
            'totalUndefinedLeads',
            'totalSuccessfulLeads',
            'totalPendingLeads',
            'totalUnsuccessfulLeads',
            'generalPanelOrders',
            'experimentalPanels',
            'freePanels',
            'couponPanels',
            'panelLess',
            'hasPanels',
            'completedOrders',
            'fromLeadCustomers',
            'totalPanelPrice'
        ));
    }


    public function users($id)
    {
        $currentUser = $this->auth->user();
        if($currentUser->id != $id && ! $currentUser->hasAnyAccess(['view_user_stats'])) {
            App::abort(404);
        }

        try {
            $user = $this->execute(GetUserCommand::class,['userId' => $id]);
            $stats = $this->execute(
                UserStatsCommand::class,
                ['user' => $user, 'start' => Input::get('start'), 'end' => Input::get('end')]
            );
            return $this->view('admin.pages.stat.my_whole', compact('stats', 'user'));
        }catch (NotFoundException $e){
            return App::abort(404);
        }
    }
} 
