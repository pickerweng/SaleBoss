<?php

namespace Controllers;


class UserController extends BaseController
{
	/**
	 * User Dashboard page
	 *
	 * @return mixed
	 */
	public function getDash()
	{
		return $this->view('admin.pages.dashboard.main');
	}
}