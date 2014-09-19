<?php namespace SaleBoss\Services\Stats\Commands; 

class UserStatsCommand
{

    public $user;
    public $startRange;
    public $endRange;

    public function __construct($user, $start = null, $end = null)
    {
        $this->user = $user;
        $this->start = $start;
        $this->end = $end;
    }
} 
