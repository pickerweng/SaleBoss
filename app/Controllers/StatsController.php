<?php namespace Controllers; 

use Carbon\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use SaleBoss\Models\Order;
use SaleBoss\Repositories\LeadRepositoryInterface;
use SaleBoss\Repositories\OrderRepositoryInterface;
use SaleBoss\Repositories\UserRepositoryInterface;
use SaleBoss\Services\Authenticator\AuthenticatorInterface;

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
        $user = $this->userRepo->findById($id);
        if($currentUser->id != $id && ! $currentUser->hasAnyAccess(['view_user_stats']))
        {
            App::abort(404);
        }
        $before = Input::get('period');
        if (!empty($before))
        {
            $before = Carbon::createFromTimestamp(strtotime('tomorrow') - ((int) $before * 24 * 60 * 60))->toDateTimeString();
        }
        $totalOrders = $this->orderRepo->countWithQuery($before, ['creator_id' => $user->id]);
        $totalCustomers = $this->userRepo->countAllCustomers($before, ['creator_id' => $user->id]);
        $totalLeads = $this->leadRepo->countWithQuery($before, ['creator_id' => $user->id]);
        $totalUndefinedLeads = $this->leadRepo->countWithQuery($before,['status' => 0, 'creator_id' => $user->id]);
        $totalSuccessfulLeads = $this->leadRepo->countWithQuery($before, ['status' => 1, 'creator_id' => $user->id]);
        $totalUnsuccessfulLeads = $this->leadRepo->countWithQuery($before, ['status' => -1, 'creator_id' => $user->id]);
        $totalPendingLeads = $this->leadRepo->countWithQuery($before, ['status' => 2, 'creator_id' => $user->id]);
        $generalPanelOrders = $this->orderRepo->countWithQuery($before, ['panel_type' => 0, 'creator_id' => $user->id]);
        $experimentalPanels = $this->orderRepo->countWithQuery($before, ['panel_type' => 2, 'creator_id' => $user->id]);
        $freePanels = $this->orderRepo->countWithQuery($before,['panel_type' => 1, 'creator_id' => $user->id]);
        $couponPanels = $this->orderRepo->countWithQuery($before, ['panel_type' => 3, 'creator_id' => $user->id]);
        $panelLess = $this->orderRepo->countWithQuery($before, ['panel_type' => 4,'creator_id' => $user->id]);
        $hasPanels = $this->orderRepo->countWithQuery($before, ['panel_type' => 5, 'creator_id' => $user->id]);
        $completedOrders = $this->orderRepo->countWithQuery($before , ['completed' => 1, 'creator_id' => $user->id]);
        $fromLeadCustomers = $this->userRepo->countWithLead($before, ['creator_id' => $user->id]);
        $totalPanelPrice = $this->orderRepo->sumPanelPrice($before, ['creator_id' => $user->id]);
	    $scoreList = Order::with('creator')->groupBy('creator_id')
		                                    ->where('completed',true)
		                                    ->where('panel_type',0)
		                                    ->orderBy('totalCount','DESC');
	    if(!empty($before)){
		    $scoreList = $scoreList->where('created_at','>', $before);
	    }
	    $scoreList = $scoreList->get(['creator_id', DB::raw('count(*) as totalCount'), DB::raw('sum(panel_price) as totalPrice')]);
        return $this->view('admin.pages.stat.my_whole',compact(
            'totalOrders',
            'totalLeads',
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
            'totalPanelPrice',
            'scoreList',
            'user'
        ));
    }
} 
