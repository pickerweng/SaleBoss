<?php

namespace SaleBoss\Services\Leads\My\Commands;


class ListWithTimeCommand {

    public $user;
    public $firstTime;
    public $secondTime;

    public function __construct($user, $firstTime = null ,$secondTime = null)
    {
        $this->user = $user;
        $this->firstTime = $firstTime;
        $this->secondTime = $secondTime;
    }
} 