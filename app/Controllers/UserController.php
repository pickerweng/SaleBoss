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
		return View::make('panel.pages.user.dash');
	}
} 