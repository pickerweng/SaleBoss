<?php

namespace SaleBoss\Services\Authenticator;


interface AuthenticatorInterface {
	public function attempt($data);
} 