<?php

namespace Controllers;


class UserController extends BaseController
{

	protected $layout = 'panel.layouts.master';
	/**
	 * User Dashboard page
	 *
	 * @return mixed
	 */
	public function getDash()
	{
		$this->view('panel.pages.user.dash');
	}
} 