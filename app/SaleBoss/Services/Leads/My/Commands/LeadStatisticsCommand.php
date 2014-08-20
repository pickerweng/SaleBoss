<?php  namespace SaleBoss\Services\Leads\My\Commands; 
use SaleBoss\Models\User;

class LeadStatisticsCommand {

	public $user;
	public $period;

	public function __construct(
		User $user,
		$period = null
	){
		$this->user = $user;
		$this->period = $period;
	}
} 