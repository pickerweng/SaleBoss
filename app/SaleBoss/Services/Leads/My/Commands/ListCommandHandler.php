<?php

namespace SaleBoss\Services\Leads\My\Commands;

use Laracasts\Commander\CommandHandler;
use SaleBoss\Repositories\LeadRepositoryInterface;
use SaleBoss\Services\Authenticator\AuthenticatorInterface;

class ListCommandHandler implements CommandHandler {

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
        $leads = $this->leadRepo->getUserLeads($this->auth->user(), 20);
        return $leads;
    }
}