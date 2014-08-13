<?php  namespace Controllers; 
use Illuminate\Support\Collection;
use Input;
use Laracasts\Validation\FormValidationException;
use Response;
use SaleBoss\Repositories\Exceptions\RepositoryException;
use SaleBoss\Services\Leads\My\Commands\StoreLeadCommand;

class MyLeadsController extends BaseController {

	public function index()
	{
		$list = new Collection([]);
		return $this->view('admin.pages.lead.my_index')->withList($list);
	}

	public function store()
	{
		\DB::beginTransaction();
		try {
			$created = $this->execute(StoreLeadCommand::class);
			return Response::json($created);
		}catch (FormValidationException $e) {
			return Response::json($e->getErrors(),422);
		}catch (RepositoryException $e) {
			\Log::info($e);
			\DB::rollBack();
			return Response::json(['errors' => [[trans('messages.database_error')]]],422);
		}

	}
} 