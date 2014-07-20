<?php

namespace SaleBoss\Models;

use Cartalyst\Sentry\Users\Eloquent\User as SentryUser;

class User extends SentryUser {
    /**
     * Get user idetifier
     *
     * @return string
     */
    public function getIdentifier()
    {
        if (!empty($this->first_name)) return $this->first_name;
        if (!empty($this->email)) return $this->email;
        return $this->id;
    }
}