<?php namespace SaleBoss\Services\EavSmartAss\EntityFields;

use SaleBoss\Repositories\AttributeRepositoryInterface;
use SaleBoss\Services\EavSmartAss\EavManager;

class Saver {

	protected $manager;
	protected $attrRepo;

	/**
	 * @param EavManager                    $eavManager
	 * @param AttributeRepositoryInterface  $attrRepo
	 */
	public function  __construct(
		EavManager $eavManager,
		AttributeRepositoryInterface $attrRepo
	){
		$this->manager = $eavManager;
		$this->attrRepo = $attrRepo;
	}

	public function save()
	{


	}
} 
