<?php namespace SaleBoss\Repositories\Eloquent;

use SaleBoss\Models\UserBadge;
use SaleBoss\Repositories\UserBadgeRepositoryInterface;

class UserBadgeRepository extends AbstractRepository implements UserBadgeRepositoryInterface {

	protected $model;

	/**
	 * @param UserBadge $userBadge
	 */
	public function __construct(
		UserBadge $userBadge
	){
		$this->model = $userBadge;
	}

} 