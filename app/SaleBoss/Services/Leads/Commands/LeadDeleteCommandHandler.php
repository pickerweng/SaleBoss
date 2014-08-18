<?php  namespace SaleBoss\Services\Leads\Commands; 
use Laracasts\Commander\CommandHandler;
use SaleBoss\Repositories\LeadRepositoryInterface;
use SaleBoss\Services\Leads\Exceptions\AccessDeniedException;

class LeadDeleteCommandHandler implements CommandHandler {

	protected $leadRepo;

	/**
	 * @param LeadRepositoryInterface $leadRepo
	 */
	public function __construct(
		LeadRepositoryInterface $leadRepo
	){
		$this->leadRepo = $leadRepo;
	}

	/**
	 * Handle the command
	 *
	 * @param $command
	 * @throws \SaleBoss\Services\Leads\Exceptions\AccessDeniedException
	 * @return mixed
	 */
	public function handle($command)
	{
		$toBeDeleted = $this->control($command);
		$this->leadRepo->deleteByModel($toBeDeleted);
		return $toBeDeleted;
	}

	/**
	 * @author bigsinoos <pcfeeler@gmail.com>
	 *
	 * @param $command
	 * @return mixed
	 * @throws \SaleBoss\Services\Leads\Exceptions\AccessDeniedException
	 */
	private function control($command)
	{
		$toBeDeleted = $this->leadRepo->findById($command->lead_id);

		if (! isset($command->user)) return $toBeDeleted;

		if ($toBeDeleted->creator_id != $command->user->id) {
			throw new AccessDeniedException("You are not authorized lead with id {$command->lead_id}");
		}
		return $toBeDeleted;
	}
}