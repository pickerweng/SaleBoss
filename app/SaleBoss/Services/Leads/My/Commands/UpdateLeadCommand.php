<?php  namespace SaleBoss\Services\Leads\My\Commands; 
class UpdateLeadCommand {

	public $name;
	public $description;
	public $phone;
	public  $priority;
	public  $tag;
	public  $remind_at;

	public function __construct(
		$name,
		$description,
		$phone,
		$priority,
		$tag,
		$remind_at
	){
		$this->name = $name;
		$this->description = $description;
		$this->phone = $phone;
		$this->priority = $priority;
		$this->tag = $tag;
		$this->remind_at = $remind_at;
	}
} 