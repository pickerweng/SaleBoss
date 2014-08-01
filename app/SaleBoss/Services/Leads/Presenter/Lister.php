<?php namespace SaleBoss\Services\Leads\Presenter;

use Cartalyst\Sentry\Facades\Laravel\Sentry;
use Illuminate\Events\Dispatcher;
use Illuminate\Support\Facades\Input;
use SaleBoss\Models\User;
use SaleBoss\Repositories\LeadRepositoryInterface;
use SaleBoss\Repositories\UserRepositoryInterface;

class Lister {

    protected $leadRepo;
    protected $userRepo;
    protected $events;

    public function __construct(
        LeadRepositoryInterface $leadRepo,
        UserRepositoryInterface $userRepo,
        Dispatcher $events
    ){
        $this->leadRepo = $leadRepo;
        $this->userRepo = $userRepo;
        $this->events = $events;
    }


    public function listIt ()
    {
        $input = Input::all();
        if (! empty($input['my_leads']))
        {
            $input['locker_id'] = Sentry::getUser()->id;
        }
        return $this->leadRepo->getPaginated(25,true, $input, Input::get('sort_by'), Input::get('asc'));
    }


    public function listForUser(User $user)
    {
        return $this->leadRepo->getPaginated(25,true);
    }

    /**
     * Count available leads
     *
     * @return int
     */
    public function count ()
    {
        return $this->leadRepo->count();
    }

    public function countForUser(User $user, $status = '')
    {
        return $this->leadRepo->countLockedForUser($user,$status);
    }



} 