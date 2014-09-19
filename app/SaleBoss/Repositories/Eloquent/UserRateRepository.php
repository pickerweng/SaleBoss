<?php namespace SaleBoss\Repositories\Eloquent;

use SaleBoss\Models\UserRate;
use SaleBoss\Repositories\UserRateRepositoryInterface;

class UserRateRepository extends AbstractRepository implements UserRateRepositoryInterface{

	protected $model;

	/**
	 * @param UserRate $userRate
	 */
	public function __construct(
		UserRate $userRate
	){
		$this->model = $userRate;
	}

} 