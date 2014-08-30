<?php namespace SaleBoss\Services\Stats\Commands; 

class UserStatsCommand
{

    public $userId;
    public $startRange;
    public $endRange;

    public function __construct($userId, $startRange = null, $endRange = null)
    {
        $this->userId = $userId;
        $this->startRange = $startRange;
        $this->endRange = $endRange;
    }
} 
