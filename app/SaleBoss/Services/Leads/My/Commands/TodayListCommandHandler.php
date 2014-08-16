<?php

namespace SaleBoss\Services\Leads\My\Commands;

use Laracasts\Commander\CommandHandler;
use SaleBoss\Repositories\LeadRepositoryInterface;
use SaleBoss\Services\Authenticator\AuthenticatorInterface;

class TodayListCommandHandler implements CommandHandler{

    protected $leadRepo;
    protected $auth;

    public function __construct(
        LeadRepositoryInterface $leadRepo,
        AuthenticatorInterface $auth
    ){
        $this->leadRepo = $leadRepo;
        $this->auth = $auth;
    }

    /**
     * Handle the command
     *
     * @param $command
     * @return mixed
     */
    public function handle($command)
    {
        $todayEnd = strtotime('tomorrow');
        $todayStart = $todayEnd - (24 * 60 * 60);
        return $this->leadRepo->getUserLeadsBetween($this->auth->user() ,$todayStart, $todayEnd);
    }
}