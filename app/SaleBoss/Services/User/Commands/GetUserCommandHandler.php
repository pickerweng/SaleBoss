<?php namespace SaleBoss\Services\User\Commands; 

use Laracasts\Commander\CommandHandler;
use SaleBoss\Repositories\UserRepositoryInterface;

class GetUserCommandHandler implements CommandHandler
{
    protected $userRepo;

    public function __construct(UserRepositoryInterface $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    /**
     * Handle the command
     *
     * @param $command
     * @return mixed
     */
    public function handle($command)
    {
        return $this->userRepo->findById($command->userId);
    }
}
