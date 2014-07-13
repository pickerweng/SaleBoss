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

	/**
	 * List of users
	 *
	 * @return View
	 */
	public function index()
	{
		return $this->view(
			$this->getView(
					'panel.pages.user.index',
					'panel.pages.common.index'
			)
		);
	}


}