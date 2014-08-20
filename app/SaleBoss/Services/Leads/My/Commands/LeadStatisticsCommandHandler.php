<?php  namespace SaleBoss\Services\Leads\My\Commands;

use Laracasts\Commander\CommandHandler;
use SaleBoss\Repositories\LeadRepositoryInterface;
use SaleBoss\Repositories\UserRepositoryInterface;

class LeadStatisticsCommandHandler implements CommandHandler {

	protected $leadRepo;
	protected $userRepo;
	protected $before;

	public function __construct(
		LeadRepositoryInterface $leadRepo,
		UserRepositoryInterface $userRepo
	){
		$this->leadRepo = $leadRepo;
		$this->userRepo;
	}

	/**
	 * Handle the command
	 *
	 * @param $command
	 * @return mixed
	 */
	public function handle($command)
	{
		$this->getBefore($command);
		return  $this->leadRepo->getCountableStatuses($command->user, $this->before);
	}

	/**
	 * @author bigsinoos <pcfeeler@gmail.com>
	 * @param $command
	 */
	private function getBefore($command)
	{
		if ( ! empty($command->period)) {
			$this->before = strtotime('tomorrow') - (((int)$command->period + 1) * 24 * 60 * 60);
		}
	}
}