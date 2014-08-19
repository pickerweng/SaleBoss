<?php  namespace SaleBoss\Repositories; 

use SaleBoss\Models\Lead;
use SaleBoss\Models\Phone;

interface PhoneRepositoryInterface {

	/**
	 * @author bigsinoos <pcfeeler@gmail.com>
	 * Add phone to lead
	 *
	 * @param $lead
	 * @param $phone
	 * @return mixed
	 */
	public function addPhoneToLead(Lead $lead, $phone);

	/**
	 * @author bigsinoos <pcfeeler@gmail.com>
	 * Delete lead phone number
	 *
	 * @param $toBeDeleted
	 * @return mixed
	 */
	public function deleteLeadPhones(Lead $toBeDeleted);
}