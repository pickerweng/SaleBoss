<?php namespace SaleBoss\Repositories;

use Illuminate\Database\Eloquent\Model;
use SaleBoss\Models\Lead;
use SaleBoss\Models\User;

interface LeadRepositoryInterface {
    /**
     * Bulk Lead creation
     *
     * @param array $data
     * @param User  $user
     * @return mixed
     */
    public function bulkCreate(array $data, User $user = null);


    /**
     * Count available leads
     *
     *
     * @return int
     */
    public function count ();

    /**
     * Update a lead
     *
     * @param \SaleBoss\Models\Lead $lead
     * @param array                 $data
     * @return mixed
     */
    public function update (Lead $lead, array $data =[]);



	/**
	 * @author bigsinoos <pcfeeler@gmail.com>
	 * Create lead from raw unfiltered data
	 *
	 * @param array $data
	 * @return mixed
	 */
	public function createRaw(array $data);

    /**
     * @author bigsinoos <pcfeeler@gmail.com>
     * Load relationships for a lead
     *
     * @param Lead $lead
     * @return mixed
     */
    public function getAllForLead(Lead $lead);

    /**
     * @author bigsinoos <pcfeeler@gmail.com>
     * Get paginated leads of a user
     *
     * @param User $user
     * @param $int
     * @return mixed
     */
    public function getUserLeads(User $user, $int);

    /**
     * @author bigsinoos <pcfeeler@gmail.com>
     * Get user leads between an specific date
     *
     * @param User $user
     * @param $todayStart
     * @param $todayEnd
     * @return mixed
     */
    public function getUserLeadsBetween(User $user, $todayStart, $todayEnd);

    /**
     * @author bigsinoos <pcfeeler@gmail.com>
     * Delete by model
     *
     * @param Model $model
     * @return mixed
     */
    public function deleteByModel(Model $model);

    /**
     * @author bigsinoos <pcfeeler@gmail.com>
     * Delete a repo by id
     *
     * @param $id
     * @return mixed
     */
    public function deleteById($id);

    /**
     * @author bigsinoos <pcfeeler@gmail.com>
     * Group by leads statuses for a user
     *
     * @param User $user
     * @param null $before
     * @return mixed
     */
    public function getCountableStatuses(User $user, $before = null);

    /**
     * @author bigsinoos <pcfeeler@gmail.com>
     * Reminding leads of the user
     *
     * @param User $user
     * @param int $int
     * @return mixed
     */
    public function getRemindableLeads(User $user, $int = 50);

    /**
     * @author   bigsinoos <pcfeeler@gmail.com>
     * Count all
     *
     * @param null $before

     * @return int
     */
    public function countAll($before = null);
} 
