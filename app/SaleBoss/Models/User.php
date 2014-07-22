<?php

namespace SaleBoss\Models;

use Cartalyst\Sentry\Users\Eloquent\User as SentryUser;

class User extends SentryUser {

	use DateTrait;
	use ChartTrait;

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

	/**
	 * Self relationship
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function generatedUsers()
	{
		return $this->hasMany('SaleBoss\Models\User','creator_id');
	}

	/**
	 * Get a combination of first name and last name
	 *
	 * @return string
	 */
	public function name()
	{
		return "{$this->first_name} {$this->last_name}";
	}
}