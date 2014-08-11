<?php  namespace SaleBoss\Repositories\Eloquent; 

use SaleBoss\Models\Phone;
use SaleBoss\Repositories\PhoneRepositoryInterface;

class PhoneRepository extends AbstractRepository implements PhoneRepositoryInterface {

	protected $model;

	public function __construct(Phone $model)
	{
		$this->model = $model;
	}

} 