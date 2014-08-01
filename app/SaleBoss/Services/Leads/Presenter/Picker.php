<?php namespace SaleBoss\Services\Leads\Presenter;

use Carbon\Carbon;
use SaleBoss\Repositories\LeadRepositoryInterface;
use SaleBoss\Repositories\UserRepositoryInterface;
use SaleBoss\Services\Leads\Presenter\Exceptions\LeadStatusLimitException;
use SaleBoss\Services\Leads\Presenter\Exceptions\MaximumLockLimitException;
use SaleBoss\Services\Leads\Presenter\Exceptions\OnlyZeroStatusLimitException;
use SaleBoss\Services\Leads\Presenter\Exceptions\UserMinLimitException;

class Picker {

    protected $userRepo;
    protected $leadRepo;
    protected $throttle;
    protected $listener;
    protected $user;
    protected $lead;

    /**
     * @param UserRepositoryInterface $userRepo
     * @param LeadRepositoryInterface $leadRepo
     * @param Throttle                $throttle
     */
    public function __construct(
        UserRepositoryInterface $userRepo,
        LeadRepositoryInterface $leadRepo,
        Throttle $throttle
    ){
        $this->userRepo = $userRepo;
        $this->leadRepo = $leadRepo;
        $this->throttle = $throttle;
    }

    /**
     * Pick a lead for picker user property by id
     *
     * @param $id
     */
    public function pick ($id)
    {
        $this->lead = $this->leadRepo->findById($id);
        $this->throttle->setUser($this->user);
        $this->throttle->setLead($this->lead);
        $this->throttle->doCheck();
        $this->updateLeadLocker();
        $this->updateLeadLockedAt();
        $this->leadUpdate();
    }

    /**
     * Set new locker for lead
     *
     * @return $this
     */
    public function updateLeadLocker()
    {
        $this->lead->locker_id = $this->user->id;
        return $this;
    }

    /**
     * Set new locked untill
     *
     * @return $this
     */
    public function updateLeadLockedAt()
    {
        $this->lead->locked_at = Carbon::now();
        return $this;
    }

    /**
     * Process lead update
     *
     * @return $this
     */
    public function leadUpdate()
    {
        $this->lead = $this->leadRepo->update($this->lead);
        return $this;
    }

    /**
     * Set listener for picker
     *
     * @param $listener
     * @return $this
     */
    public function setListener ($listener)
    {
        $this->listener = $listener;
        return $this;
    }

    /**
     * Set user
     *
     * @param $user
     * @return $this
     */
    public function setUser ($user)
    {
        $this->user = $user;
        return $this;
    }

    /**
     * Relaeas a lead back to repository
     * @return
     */
    public function release($id)
    {

    }

}