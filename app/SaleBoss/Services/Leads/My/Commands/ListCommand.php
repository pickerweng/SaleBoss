<?php

namespace SaleBoss\Services\Leads\My\Commands;


class ListCommand {

    public $user;

    public function __construct($user)
    {
        $this->user = $user;
    }
} 