<?php namespace SaleBoss\Services\Leads\Presenter;

use Illuminate\Support\Facades\Lang;
use SaleBoss\Models\User;
use SaleBoss\Services\Leads\Presenter\Exceptions\LeadStatusLimitException;
use SaleBoss\Services\Leads\Presenter\Exceptions\MaximumLockLimitException;
use SaleBoss\Services\Leads\Presenter\Exceptions\OnlyZeroStatusLimitException;
use SaleBoss\Services\Leads\Presenter\Exceptions\UserMinLimitException;

class DelegateMan implements DelegateManInterface{

    protected $lister;
    protected $list;
    protected $currentUser;
    protected $search = [];
    protected $sort = [];
    protected $userLister;
    protected $listener;

    public function __construct(
        Lister $lister,
        UserLister $userLister,
        Picker $picker
    ){
        $this->lister = $lister;
        $this->userLister = $userLister;
        $this->picker = $picker;
    }

    /**
     * Set searchable array
     *
     * @param array $searchable
     * @return $this|mixed
     */
    public function setSearch(array $searchable)
    {
        $this->search = $searchable;
        return $this;
    }

    /**
     * Set sortable array
     *
     * @param array $sort
     * @return $this|mixed
     */
    public function setSort(array $sort)
    {
        $this->sort = $sort;
        return $this;
    }

    /**
     * Set current user
     *
     * @param User $user
     * @return $this|mixed
     */
    public function setCurrentUser(User $user)
    {
        $this->currentUser = $user;
        return $this;
    }

    /**
     * List the available list for user
     *
     * @return mixed
     */
    public function listForUser ()
    {
        return $this->lister->forUser($this->user,$this->search);
    }

    /**
     * List current user leads
     *
     * @return mixed
     */
    public function userList ()
    {
        $this->userLister->setUser($this->user);
        return $this->userLister->listIt($this->search);
    }

    /**
     * List all resources
     *
     * @return mixed
     */
    public function listIt ()
    {
        return $this->lister->listIt();
    }

    /**
     * Pick a lead by id
     *
     * @param                         $id
     * @param PickerListenerInterface $listener
     * @return mixed
     */
    public function pick ($id, PickerListenerInterface $listener)
    {
        $this->listener = $listener;
        $this->picker->setListener($this->listener);
        $this->picker->setUser($this->currentUser);
        try {
            $this->picker->pick($id);
            return $this->listener->onPickSuccess(Lang::get("messages.operation_success"));
        }catch (LeadStatusLimitException $e)
        {
            return $this->listener->onPickFail([Lang::get("messages.for_another_user_15")]);
        }catch(MaximumLockLimitException $e)
        {
            return $this->listener->onPickFail([Lang::get("messages.lead_maximum_lock")]);
        }catch(OnlyZeroStatusLimitException $e)
        {
            return $this->listener->onPickFail([Lang::get("messages.one_undefined_lead")]);
        }catch(UserMinLimitException $e)
        {
            return $this->listener->onPickFail([Lang::get("messages.lead_minute_limit")]);
        }
    }

    public function userStatistics()
    {
        $leads = $this->lister->count();
        $myLeads = $this->lister->countForUser($this->currentUser);
        $myClosedLeads = $this->lister->countForUser($this->currentUser, -1);
        return compact('leads','myLeads','myClosedLeads');
    }
}