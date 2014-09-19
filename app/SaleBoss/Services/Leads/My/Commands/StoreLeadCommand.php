<?php  namespace SaleBoss\Services\Leads\My\Commands;

class StoreLeadCommand {

	public function __construct(
		$name,
		$description,
		$phone,
		$priority,
		$tag,
		$status,
		$remind_at
	) {
		$this->name = $name;
		$this->description = $description;
		$this->phone = $phone;
		$this->priority = $priority;
		$this->remind_at = $remind_at;
		$this->tag = $tag;
		$this->status = $status;
	}
}