<?php  namespace SaleBoss\Services\Leads\My\Commands; 

use Laracasts\Commander\CommandHandler;
use SaleBoss\Repositories\LeadRepositoryInterface;

class UpdateLeadCommandHandler implements CommandHandler {

	protected $leadRepo;
	protected $lead;
	protected $commandData;

	public function __construct(
		LeadRepositoryInterface $leadRepo
	){
		$this->leadRepo = $leadRepo;
	}

	/**
	 * Handle the command
	 *
	 * @param $command
	 * @return mixed
	 */
	public function handle($command)
	{
		$this->commandData = $command;
		$this->getLead();
		return $this->updateLead();
	}

	private function getLead()
	{
		$this->lead = $this->leadRepo->findById($this->commandData->id);
		return $this->lead;
	}

	private function updateLead()
	{
		return $this->leadRepo->update($this->lead, $this->getUpdateData());
	}

	private function getUpdateData()
	{
		$neededData = ['name', 'description', 'phone', 'priority', 'tag', 'remind_at'];
		$data = [];
		foreach ($neededData as $key) {
			if (isset($this->commandData->$key)) {
				$data[$key] = $this->commandData->$key;
			}
		}
		return $data;
	}


}