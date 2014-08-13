<?php  namespace SaleBoss\Services\Leads\My\Commands; 

use Illuminate\Events\Dispatcher;
use Laracasts\Commander\CommandHandler;
use Miladr\Jalali\jDate;
use SaleBoss\Repositories\Exceptions\NotFoundException;
use SaleBoss\Repositories\LeadRepositoryInterface;
use SaleBoss\Repositories\PhoneRepositoryInterface;
use SaleBoss\Repositories\TagRepositoryInterface;
use SaleBoss\Services\Authenticator\AuthenticatorInterface;

class StoreLeadCommandHandler implements CommandHandler {

	protected $leadRepo;
	protected $events;
	protected $tagRepo;
	protected $phoneRepo;
	protected $auth;

	/**
	 * @param LeadRepositoryInterface $leadRepo
	 * @param Dispatcher $events
	 * @param PhoneRepositoryInterface $phoneRepo
	 * @param TagRepositoryInterface $tagRepo
	 * @param AuthenticatorInterface $auth
	 */
	public function __construct(
		LeadRepositoryInterface $leadRepo,
		Dispatcher $events,
		PhoneRepositoryInterface $phoneRepo,
		TagRepositoryInterface $tagRepo,
		AuthenticatorInterface $auth
	){
		$this->leadRepo = $leadRepo;
		$this->events = $events;
		$this->phoneRepo = $phoneRepo;
		$this->tagRepo = $tagRepo;
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
		$phone = $command->phone;
		$tag = $command->tag;
		$command->remind_at = $this->getRemindAtFromDays($command->remind_at);

		$lead = $this->leadCreate($command);
		$tag = $this->getTag($tag);
		$lead = $this->tagRepo->addTagToLead($lead, $tag);

		$lead = $this->phoneRepo->addPhoneToLead($lead, $phone);

		$this->events->fire('my.leads.created',array($lead));

		$lead = $this->leadRepo->getAllForLead($lead);

		return $lead;
	}

	/**
	 * @author bigsinoos <pcfeeler@gmail.com>
	 * Create or find tag
	 *
	 * @param $tagName
	 * @return mixed
	 */
	private function getTag($tagName)
	{
		try{
			$tag = $this->tagRepo->findByName($tagName);
			return $tag;
		}catch (NotFoundException $e){
			return $tag = $this->tagRepo->createRaw(['name' => $tagName]);
		}
	}

	/**
	 * @author bigsinoos <pcfeeler@gmail.com>
	 * Create Lead
	 *
	 * @param $command
	 * @return mixed
	 */
	private function leadCreate($command)
	{
		$command = $this->prepareForLeadRepo($command);
		return $this->leadRepo->createRaw(get_object_vars($command));
	}

	/**
	 * @author bigsinoos <pcfeeler@gmail.com>
	 * Filter command data for lead repository
	 *
	 * @param $command
	 */
	private function prepareForLeadRepo($command)
	{
		$command->creator_id = $this->auth->user()->id;
		unset($command->phone);
		unset($command->tag);
		return $command;
	}

	/**
	 * @author bigsinoos <pcfeeler@gmail.com>
	 * Get data from future days
	 *
	 * @param $remindAt
	 * @return null
	 */
	private function getRemindAtFromDays($remindAt)
	{
		if (is_null($remindAt)) return null;
		return $remindAt = jDate::forge("now + {$remindAt} days")->time();
	}
}