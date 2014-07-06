<?php

namespace Controllers;


use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
use SaleBoss\Services\Authenticator\Exceptions\InvalidCredentialsException;
use SaleBoss\Services\Authenticator\Exceptions\ValidationException;
use SaleBoss\Services\Authenticator\SentryAuthenticator;

class AuthController extends BaseController {

	protected $auth;

	/**
	 * @param SentryAuthenticator $auth
	 */
	public function __construct(
		SentryAuthenticator $auth
	)
	{
		$this->auth = $auth;
	}



	/**
	 *
	 */
	public function getLogin()
	{
		View::share('bodyIds','login-body');
		return View::make('panel.pages.auth.login');
	}

	/**
	 *
	 */
	public function postLogin()
	{
		$input = Input::all();
		try{
			$attempt = $this->auth->attempt($input);
			return Redirect::to('dash');
		}catch (ValidationException $e)
		{
			return Redirect::back()->withErrors($this->auth->getErrors());
		}catch(InvalidCredentialsException $e){
			return Redirect::back()->with('error_message','ترکیب شناسه کاربری و رمز عبور صحیح نمیباشد');
		}
	}

	/**
	 *
	 */
	public function getRegister()
	{

	}

	/**
	 *
	 */
	public function postRegister()
	{

	}


} 