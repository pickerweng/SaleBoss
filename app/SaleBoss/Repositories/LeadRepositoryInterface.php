<?php namespace SaleBoss\Repositories;

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
     * Get paginated list of leads
     *
     * @param        $int
     * @param        $withLocker
     * @param array  $search
     * @param string $sortBy
     * @param bool   $asc
     * @return mixed
     */
    public function getPaginated ($int, $withLocker, array $search = [], $sortBy = 'created_at', $asc = false);

    /**
     * Get users last lead
     *
     * @param User $user
     * @return mixed
     */
    public function getUserLastLockedLead (User $user);

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
     * Get user leads that has argument status
     *
     * @param \SaleBoss\Models\User $user
     * @param                       $int
     * @return mixed
     */
    public function getUserLeadsWithStatus (User $user,$int);

    public function countLockedForUser (User $user, $status = null);
} 