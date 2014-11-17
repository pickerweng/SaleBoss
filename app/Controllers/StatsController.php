<?php namespace Controllers; 


use Miladr\Jalali;
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
//        $before = Input::get('period');
        $firstTime = Input::get('from');
        $secondTime = Input::get('to');

        if (!empty($firstTime) & !empty($secondTime)) {
            $firstTimeEx = explode('-', $firstTime);
            $firstTimeG = Jalali\jDateTime::toGregorian($firstTimeEx[0], $firstTimeEx[1], $firstTimeEx[2]);
            $firstTime = $firstTimeG[0] . '-' . $firstTimeG[1] . '-' . $firstTimeG[2] . ' 00:00';

            $secondTimeEx = explode('-', $secondTime);
            $secondTimeG = Jalali\jDateTime::toGregorian($secondTimeEx[0], $secondTimeEx[1], $secondTimeEx[2]);
            $secondTime = $secondTimeG[0] . '-' . $secondTimeG[1] . '-' . $secondTimeG[2] . ' 00:00';
        }

        $totalOrders = $this->orderRepo->countAll($firstTime, $secondTime);
        $totalCustomers = $this->userRepo->countAllCustomers($firstTime, $secondTime);
        $totalLeads = $this->leadRepo->countAll($firstTime, $secondTime);
        $totalSystemUsers = $this->userRepo->countAllUsers($firstTime, $secondTime);
        $totalUndefinedLeads = $this->leadRepo->countWithQuery($firstTime, $secondTime,['status' => 0]);
        $totalSuccessfulLeads = $this->leadRepo->countWithQuery($firstTime, $secondTime, ['status' => 1]);
        $totalUnsuccessfulLeads = $this->leadRepo->countWithQuery($firstTime, $secondTime, ['status' => -1]);
        $totalPendingLeads = $this->leadRepo->countWithQuery($firstTime, $secondTime, ['status' => 2]);
        $generalPanelOrders = $this->orderRepo->countWithQuery($firstTime, $secondTime, ['panel_type' => 0]);
        $experimentalPanels = $this->orderRepo->countWithQuery($firstTime, $secondTime, ['panel_type' => 2]);
        $freePanels = $this->orderRepo->countWithQuery($firstTime, $secondTime,['panel_type' => 1]);
        $couponPanels = $this->orderRepo->countWithQuery($firstTime, $secondTime, ['panel_type' => 3]);
        $panelLess = $this->orderRepo->countWithQuery($firstTime, $secondTime, ['panel_type' => 4]);
        $hasPanels = $this->orderRepo->countWithQuery($firstTime, $secondTime, ['panel_type' => 5]);
        $completedOrders = $this->orderRepo->countWithQuery($firstTime , $secondTime, ['completed' => 1]);
        $fromLeadCustomers = $this->userRepo->countWithLead($firstTime, $secondTime);
        $totalPanelPrice = $this->orderRepo->sumPanelPrice($firstTime, $secondTime);
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
        $firstTime = Input::get('from');
        $secondTime = Input::get('to');

        if (!empty($firstTime) & !empty($secondTime)) {
            $firstTimeEx = explode('-', $firstTime);
            $firstTimeG = Jalali\jDateTime::toGregorian($firstTimeEx[0], $firstTimeEx[1], $firstTimeEx[2]);
            $firstTime = $firstTimeG[0] . '-' . $firstTimeG[1] . '-' . $firstTimeG[2] . ' 00:00';

            $secondTimeEx = explode('-', $secondTime);
            $secondTimeG = Jalali\jDateTime::toGregorian($secondTimeEx[0], $secondTimeEx[1], $secondTimeEx[2]);
            $secondTime = $secondTimeG[0] . '-' . $secondTimeG[1] . '-' . $secondTimeG[2] . ' 00:00';
        }
        $totalOrders = $this->orderRepo->countWithQuery($firstTime, $secondTime, ['creator_id' => $user->id]);
        $totalCustomers = $this->userRepo->countAllCustomers($firstTime, $secondTime, ['creator_id' => $user->id]);
        $totalLeads = $this->leadRepo->countWithQuery($firstTime, $secondTime, ['creator_id' => $user->id]);
        $totalUndefinedLeads = $this->leadRepo->countWithQuery($firstTime, $secondTime,['status' => 0, 'creator_id' => $user->id]);
        $totalSuccessfulLeads = $this->leadRepo->countWithQuery($firstTime, $secondTime, ['status' => 1, 'creator_id' => $user->id]);
        $totalUnsuccessfulLeads = $this->leadRepo->countWithQuery($firstTime, $secondTime, ['status' => -1, 'creator_id' => $user->id]);
        $totalPendingLeads = $this->leadRepo->countWithQuery($firstTime, $secondTime, ['status' => 2, 'creator_id' => $user->id]);
        $generalPanelOrders = $this->orderRepo->countWithQuery($firstTime, $secondTime, ['panel_type' => 0, 'creator_id' => $user->id]);
        $experimentalPanels = $this->orderRepo->countWithQuery($firstTime, $secondTime, ['panel_type' => 2, 'creator_id' => $user->id]);
        $freePanels = $this->orderRepo->countWithQuery($firstTime, $secondTime,['panel_type' => 1, 'creator_id' => $user->id]);
        $couponPanels = $this->orderRepo->countWithQuery($firstTime, $secondTime, ['panel_type' => 3, 'creator_id' => $user->id]);
        $panelLess = $this->orderRepo->countWithQuery($firstTime, $secondTime, ['panel_type' => 4,'creator_id' => $user->id]);
        $hasPanels = $this->orderRepo->countWithQuery($firstTime, $secondTime, ['panel_type' => 5, 'creator_id' => $user->id]);
        $completedOrders = $this->orderRepo->countWithQuery($firstTime, $secondTime , ['completed' => 1, 'creator_id' => $user->id]);
        $fromLeadCustomers = $this->userRepo->countWithLead($firstTime, $secondTime, ['creator_id' => $user->id]);
        $totalPanelPrice = $this->orderRepo->sumPanelPrice($firstTime, $secondTime, ['creator_id' => $user->id]);
	    $scoreList = Order::with('creator')->groupBy('creator_id')
		                                    ->where('completed',true)
		                                    ->where('panel_type',0)
		                                    ->orderBy('totalCount','DESC');
        if(!empty($firstTime) or !empty($secondTime)) {
            $q = $scoreList->whereBetween('created_at', array($firstTime, $secondTime));
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
