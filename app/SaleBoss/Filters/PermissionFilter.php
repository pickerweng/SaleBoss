<?php
namespace SaleBoss\Filters;

use Cartalyst\Sentry\Facades\Laravel\Sentry;
use Illuminate\Support\Facades\Redirect;

class PermissionFilter {
	/**
	 * @param $route
	 * @param $request
	 * @param $value
	 * @return mixed
	 */
	public function hasPermission(
		$route,
		$request,
		$value
	){
		if (! Sentry::check()) return Redirect::to('aut/login');
		$user = Sentry::getUser();
		if ( ! $user->hasAccess($value)){
			return Redirect::to('dash')->with(
				'error_message',
				'شما دسترسی به صفحه مورد نظر را ندارید.'
			);
		}
	}
} 
