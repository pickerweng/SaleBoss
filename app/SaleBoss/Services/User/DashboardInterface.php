<?php namespace SaleBoss\Services\User;

use SaleBoss\Models\User;

interface DashboardInterface {
	public function setUser(User $user);
	public function getHisDash();
} 