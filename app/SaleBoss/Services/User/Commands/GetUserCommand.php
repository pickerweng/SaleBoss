<?php namespace SaleBoss\Services\User\Commands; 

class GetUserCommand
{
    public $userId;

    public function __construct($userId)
    {
        $this->userId = $userId;
    }
} 
