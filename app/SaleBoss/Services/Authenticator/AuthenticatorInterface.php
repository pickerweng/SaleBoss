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

    /**
     * Check that user is logged in or not
     *
     * @return boolean
     */
    public function check();

    /**
     * Logout th user
     *
     * @return boolean
     */
    public function logout();

    /**
     * Get possible errors
     *
     * @return MessageBag
     */
    public function getErrors();
}