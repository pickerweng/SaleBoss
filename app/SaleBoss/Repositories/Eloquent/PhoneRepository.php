<?php  namespace SaleBoss\Repositories\Eloquent; 

use Illuminate\Database\QueryException;
use SaleBoss\Models\Lead;
use SaleBoss\Models\Phone;
use SaleBoss\Repositories\Exceptions\RepositoryException;
use SaleBoss\Repositories\PhoneRepositoryInterface;

class PhoneRepository extends AbstractRepository implements PhoneRepositoryInterface {

	protected $model;

	public function __construct(Phone $model)
	{
		$this->model = $model;
	}

	/**
	 * @author bigsinoos <pcfeeler@gmail.com>
	 * Add phone to lead
	 *
	 * @param Lead $lead
	 * @param $phone
	 * @throws \SaleBoss\Repositories\Exceptions\RepositoryException
	 * @return mixed
	 */
	public function addPhoneToLead(Lead $lead, $phone)
	{
		try {
			if ($phone instanceof Phone) {
				return $this->addPhoneModelToLead($lead, $phone);
			}
			return $this->createAddPhoneModelToLead($lead , $phone);
		}catch (QueryException $e) {
			throw new RepositoryException($e->getMessage());
		}
	}

	/**
	 * @author bigsinoos <pcfeeler@gmail.com>
	 * Add a phone model to a lead
	 *
	 * @param Lead $lead
	 * @param Phone $phone
	 * @return Lead
	 */
	private function addPhoneModelToLead(Lead $lead,Phone $phone)
	{
		$lead->phones()->attach($phone);
		return $lead;
	}

	/**
	 * @author bigsinoos <pcfeeler@gmail.com>
	 * Create and add phone number to a lead model
	 *
	 * @param Lead $lead
	 * @param $phone
	 * @return Lead
	 */
	private function createAddPhoneModelToLead(Lead $lead, $phone)
	{
		$phoneModel = new Phone();
		$phoneModel->number = $phone;
		$lead->phones()->save($phoneModel);
		return $lead;
	}

	/**
	 * @author bigsinoos <pcfeeler@gmail.com>
	 * Delete lead phone number
	 *
	 * @param $toBeDeleted
	 * @return mixed
	 */
	public function deleteLeadPhones(Lead $toBeDeleted)
	{
		$deleteQueue = $toBeDeleted->phones()->get();
		foreach($deleteQueue as $item)
		{
			$item->delete();
		}
	}

    public function syncLeadPhones($lead, $phones)
    {
        $lead->phones()->sync($phones);
        return $lead;
    }

    public function deleteByNumber($number)
    {
        $phone = $this->model->where('number','=',$number)->first();
        if (!is_null($phone))
        {
            $phone->delete();
        }
    }
}
