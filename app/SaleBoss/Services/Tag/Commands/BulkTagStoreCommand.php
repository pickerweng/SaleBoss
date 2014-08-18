<?php  namespace SaleBoss\Services\Tag\Commands; 
class BulkTagStoreCommand {

	public $data;
	public $additionalData;

	public function __construct(
		$data,
		$additionalData = null
	){
		$this->data = $data;
		$this->additionalData = $additionalData;
	}
} 