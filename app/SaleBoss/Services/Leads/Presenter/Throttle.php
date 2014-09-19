<?php namespace SaleBoss\Services\Leads\Presenter;

use SaleBoss\Models\Lead;
use SaleBoss\Models\User;
use SaleBoss\Repositories\Exceptions\NotFoundException;
use SaleBoss\Repositories\LeadRepositoryInterface;
use SaleBoss\Services\Leads\Presenter\Exceptions\LeadStatusLimitException;
use SaleBoss\Services\Leads\Presenter\Exceptions\MaximumLockLimitException;
use SaleBoss\Services\Leads\Presenter\Exceptions\OnlyZeroStatusLimitException;
use SaleBoss\Services\Leads\Presenter\Exceptions\ThrottleException;
use SaleBoss\Services\Leads\Presenter\Exceptions\UserMinLimitException;

class Throttle implements ThrottleInterface {

    protected $user;
    protected $leadRepo;
    protected $lead;
    protected $userLastLead;
    protected $undefinedLeads;

    /**
     * @param LeadRepositoryInterface $leadRepo
     */
    public function __construct(
        LeadRepositoryInterface $leadRepo
    ){
        $this->leadRepo = $leadRepo;
    }

    /**
     * Set the user that throttle works on him
     *
     * @param User $user
     * @return $this
     */
    public function setUser(User $user)
    {
        $this->user = $user;
        return $this;
    }

    /**
     * Set the lead that throttle works on it
     *
     * @param Lead $lead
     */
    public function setLead(Lead $lead)
    {
        $this->lead = $lead;
    }

    /**
     * Do All checks
     *
     * @return bool
     */
    public function doCheck()
    {
        $this->passesUserMinLimit();
        $this->passesLeadStatusLimit();
        $this->passesOnlyZeroStatusLimit();
        $this->passesMaximumLockLimit();
        return true;
    }

    /**
     * User pass minute limit scenario
     *
     * @return bool
     * @throws UserMinLimitException
     */
    private function passesUserMinLimit ()
    {
        // Get last locked lead by user
        // Here we check it for five minutes
        // If it is for last current five minutes
        // We reject current taking request
        $fiveMinutesAgo = time() - (60 * 5);
        try
        {
            if (is_null($this->userLastLead))
            {
                $this->userLastLead = $this->leadRepo->getUserLastLockedLead($this->user);
            }

            if( strtotime($this->userLastLead->locked_at) >= $fiveMinutesAgo)
            {
                throw new UserMinLimitException("User can only subscribe to leads each 5 minutes");
            }
            return true;
        }catch (NotFoundException $e)
        {
            return true;
        }
    }

    /**
     * Allow request if locker is inactive
     *
     * @return bool
     * @throws LeadStatusLimitException
     */
    private function passesLeadStatusLimit ()
    {
        // We allow a user to subscribe to a lead
        // that it's status has been 0 (undefined) for more
        // than 15 minutes
        $minutesAgo = time() - (15 * 60);

        if (is_null($this->lead->locked_at) || is_null($this->lead->locker_id))
        {
            return true;
        }

        if (($this->lead->status == 0) && (strtotime($this->lead->locked_at) < $minutesAgo))
        {
            return true;
        }
        throw new LeadStatusLimitException(
            "User can not subscribe to a lead that another user has subscribed to it in last 15 minutes."
        );
    }

    /**
     * User can only have one undefined lead
     *
     * @throws Exceptions\OnlyZeroStatusLimitException
     * @return bool
     */
    private function passesOnlyZeroStatusLimit ()
    {
        // We allow a user to only have
        // one undefined lead
        // If it is more alarm him and reject !!!
        try {
            if (is_null($this->undefinedLeads))
            {
                $this->undefinedLeads = $this->leadRepo->getUserLeadsWithStatus($this->user,0);
            }
            throw new OnlyZeroStatusLimitException(
                "User can only have one undefined lead"
            );
        }catch (NotFoundException $e){
            return true;
        }
    }

    private function passesNotCompletedStatus()
    {
        if ($this->lead->status == 1)
        {
            throw new NotCompletedStatus("You can not get a completed lead");
        }
        return true;
    }

    private function passesMaximumLockLimit ()
    {
        // If lead is attached to another user
        // and it is more than 40 days
        // That that user is working on this lead
        // We allow current request
        $daysAgo = time() - (40 * 24 * 60  * 60);

        if (strtotime($this->lead->loecked_at) < $daysAgo)
        {
            return true;
        }
        throw new MaximumLockLimitException("Lead is in another user's progress");
    }

    public function allows(Lead $lead)
    {
        try {
            $this->setLead($lead);
            $this->doCheck();
            return true;
        }catch (ThrottleException $e){
            return false;
        }
    }

    public function minLimit()
    {
        try {
            $this->passesUserMinLimit();
            return true;
        }catch(ThrottleException $e){
            return false;
        }
    }

    public function oneUndefined()
    {
        try {
            $this->passesOnlyZeroStatusLimit();
            return true;
        }catch (ThrottleException $e){
            return false;
        }
    }
} 