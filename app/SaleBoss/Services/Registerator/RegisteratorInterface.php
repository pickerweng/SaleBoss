<?php

namespace SaleBoss\Services\Registerator;

use Illuminate\Support\MessageBag;

interface RegisteratorInterface {
	/**
	 * User directly registers him self throught out a form
	 *
	 * @param $data
	 * @param array $roles
	 * @param bool $activated
	 * @param bool $suspended
	 * @return boolean
	 */
	public function directRegister($data, array $roles = ['authenticated'], $activated = true);

	/**
	 * User registers him selfs with a deligator (a saler for example)
	 *
	 * @param $data
	 * @param array $roles
	 * @param bool $activated
	 * @param bool $suspended
	 * @return boolean
	 */
	public function deligatorRegister($data, array $roles = ['authenticated'], $activated = true , $suspended = false);

	/**
	 * Return errors on validation or something
	 *
	 * @return MessageBag
	 */
	public function getErrors();
} 