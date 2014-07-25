<?php

namespace SaleBoss\Models;

use Cartalyst\Sentry\Users\Eloquent\User as SentryUser;
use Illuminate\Support\Facades\Config;
use Miladr\Jalali\jDate;

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

    /**
     * User Custom avatar generator
     *
     * @return int
     */
    public function avatar()
    {
        return 'files/avatars/' . (($this->id % 10) + 1) . '.gif';
    }

    /**
     * Self relationship between user and it's creator
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function creator()
    {
        return $this->belongsTo('SaleBoss\Models\User','creator_id');
    }

    /**
     * Accessor for getting connection_way from config
     *
     * @return string
     */
    public function getConnectionWayAttribute($value)
    {
        $config = Config::get('connection_types');
        if (isset($config[$value]))
        {
            return $config[$value];
        }else
        {
            return  $value;
        }
    }

    /**
     * Jalali date
     *
     * @return string
     */
    public function jalaliDate($attr)
    {
        $timestamp = strtotime($this->$attr);
        return jDate::forge($timestamp)->format('date');
    }

    /**
     * Jalali date with ago format
     *
     * @param $attr
     * @return string
     */
    public function jalaliAgoDate($attr)
    {
        $timestamp = strtotime($this->$attr);
        return jDate::forge($timestamp)->ago();
    }

}