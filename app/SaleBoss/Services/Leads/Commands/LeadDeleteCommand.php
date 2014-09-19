<?php  namespace SaleBoss\Services\Leads\Commands; 
use SaleBoss\Models\User;

class LeadDeleteCommand {

	public $user;
	public $lead_id;

	public function __construct(
		User $user = null,
		$lead_id
	){
		$this->lead_id  = $lead_id;
		if (! is_null($user))
		{
			$this->user = $user;
		}
	}
} 