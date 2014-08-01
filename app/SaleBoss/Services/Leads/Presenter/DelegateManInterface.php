<?php namespace SaleBoss\Services\Leads\Presenter;

use SaleBoss\Models\User;

interface DelegateManInterface {

    /**
     * Set searchable array
     *
     * @param array $search
     * @return mixed
     */
    public function setSearch(array $search);

    /**
     * Set sortable array
     *
     * @param array $sort
     * @return mixed
     */
    public function setSort(array $sort);

    /**
     * Set the user
     *
     * @param User $user
     * @return mixed
     */
    public function setCurrentUser(User $user);

    /**
     * List the available list for user
     *
     * @return mixed
     */
    public function listForUser ();

    /**
     * List current user leads
     *
     * @return mixed
     */
    public function userList ();

    /**
     * List all resources
     *
     * @internal param array $input
     * @return mixed
     */
    public function listIt ();

    /**
     * Pick a lead by id
     *
     * @param                         $id
     * @param PickerListenerInterface $listener
     * @return mixed
     */
    public function pick ($id, PickerListenerInterface $listener);

    /**
     * Update lead
     *
     * @param $id
     * @param $input
     * @param $listener
     * @return mixed
     */
    // public function update ($id,$input, $listener);
} 