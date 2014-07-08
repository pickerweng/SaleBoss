<?php

namespace SaleBoss\Services\Authenticator;


interface AuthenticatorInterface {
	/**
	 * Attempt a login
	 *
	 * @param $data
	 * @return boolean
	 */
	public function attempt($data);
} 