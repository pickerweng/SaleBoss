<?php

namespace SaleBoss\Services\Leads\My\Commands;

use Laracasts\Commander\CommandHandler;
use SaleBoss\Repositories\LeadRepositoryInterface;
use SaleBoss\Services\Authenticator\AuthenticatorInterface;

class ListWithTimeCommandHandler implements CommandHandler {

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
     * @param ListCommand $command
     * @return mixed
     */
    public function handle($command)
    {

        $leads = $this->leadRepo->getUserLeadByTime($command->user, $command->firstTime, $command->secondTime, 20);
        return $leads;
    }
}