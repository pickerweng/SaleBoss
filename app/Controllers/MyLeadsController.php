<?php  namespace Controllers; 
use Illuminate\Support\Collection;
use Input;
use Laracasts\Validation\FormValidationException;
use Response;
use SaleBoss\Repositories\Exceptions\RepositoryException;
use SaleBoss\Services\Authenticator\AuthenticatorInterface;
use SaleBoss\Services\Leads\My\Commands\ListCommand;
use SaleBoss\Services\Leads\My\Commands\StoreLeadCommand;
use SaleBoss\Services\Leads\My\Commands\TodayListCommand;

class MyLeadsController extends BaseController {

    protected $auth;

    public function __construct(
      AuthenticatorInterface $auth
    ){
        $this->auth = $auth;
    }

	public function index()
	{
        $todayList = $this->execute(TodayListCommand::class);
		$list = $this->execute(ListCommand::class);
		return $this->view('admin.pages.lead.my_index')
                    ->withList($list)
                    ->withCurrentUser($this->auth->user())
                    ->with('todayList',$todayList);
	}

	public function store()
	{
		try {
			$created = $this->execute(StoreLeadCommand::class);
			return Response::json($created);
		}catch (FormValidationException $e) {
			return Response::json($e->getErrors(),422);
		}catch (RepositoryException $e) {
			return Response::json(['errors' => [[trans('messages.database_error')]]],422);
		}
	}
} 