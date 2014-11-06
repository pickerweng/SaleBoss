<?php namespace SaleBoss\Services\Leads\Creator;

use SaleBoss\Models\User;

interface CreatorInterface {
    /**
     * Bulk Creation of data when an array is given
     *
     * @param array $data
     * @return mixed
     */
    public function bulkCreate(array $data, $user_id = null);

    /**
     * Create a single lead
     *
     * @param array $item
     * @return mixed
     */
    public function create(array $item);

    /**
     * Set listener to do outgoing jobs
     *
     * @param CreatorListenerInterface $listener
     * @return \SaleBoss\Services\Leads\Creator\CreatorListenerInterface
     */
    public function setListener(CreatorListenerInterface $listener);

    /**
     * Set creator user
     *
     * @param User $currentUser
     * @return \SaleBoss\Services\Leads\Creator\CreatorListenerInterface
     */
    public function setCreator (User $currentUser);

    /**
     * Count created data
     *
     * @return int
     */
    public function count ();
}