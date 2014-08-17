<?php  namespace SaleBoss\Services\Leads\My\Commands;
use Laracasts\Commander\CommandHandler;
use SaleBoss\Repositories\LeadRepositoryInterface;
use SaleBoss\Services\Authenticator\AuthenticatorInterface;

class WeekListCommandHandler implements CommandHandler {

	protected $auth;
	protected  $leadRepo;

	public function __construct(
		LeadRepositoryInterface $leadRepo,
		AuthenticatorInterface $auth
	){
		$this->leadRepo = $leadRepo;
		$this->auth = $auth;
	}

	/**
	 * Handle the command
	 *
	 * @param $command
	 * @return mixed
	 */
	public function handle($command)
	{
		$weekBegin = strtotime('Last Saturday');
		$weekEnd = strtotime('Next Saturday');
		return $this->leadRepo->getUserLeadsBetween($this->auth->user(),$weekBegin, $weekEnd);
	}
}