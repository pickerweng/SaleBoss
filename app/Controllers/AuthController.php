<?php

namespace Controllers;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Lang;
use SaleBoss\Services\Authenticator\Exceptions\InvalidCredentialsException;
use SaleBoss\Services\Authenticator\Exceptions\UserNotActivatedException;
use SaleBoss\Services\Authenticator\Exceptions\ValidationException;
use SaleBoss\Services\Authenticator\SentryAuthenticator;
use SaleBoss\Services\Registerator\Exceptions\RegisterNeedException;
use SaleBoss\Services\Registerator\Exceptions\UserExistsException;
use SaleBoss\Services\Registerator\Sentry\Registerator;

class AuthController extends BaseController {

	protected $auth;
	protected $reg;

	/**
	 * @param SentryAuthenticator $auth
	 * @param Registerator $reg
	 */
	public function __construct(
		SentryAuthenticator $auth,
		Registerator $reg
	)
	{
		$this->auth = $auth;
		$this->reg = $reg;
	}

    /**
     * User Login page
     *
     * @return View
     */
    public function getLogin()
	{
		return $this->view('admin.pages.login.main');
	}

    /**
     * Login the user and redirect to dash
     *
     * @return Redirect
     */
    public function postLogin()
	{
		$input = Input::only('identifier','password','remember');
		try{
			$this->auth->attempt($input);
            if (! $redirect = Input::get('redirect')){
                $redirect = 'dash';
            }
			return $this->redirectTo($redirect)->with(
                'success_message',
                Lang::get('messages.welcome', array(':name' => $this->auth->user()))
            );
		}catch (ValidationException $e){
			return $this->redirectBack()->withErrors($this->auth->getErrors());
		}catch(InvalidCredentialsException $e){
			return $this->redirectBack()->with('error_message','ترکیب شناسه کاربری و رمز عبور صحیح نمیباشد');
		}catch(UserNotActivatedException $e){
			return $this->redirectBack()->with('error_message','پروفایل شما هنوز فعال نشده است');
		}
	}

	/**
	 *
	 */
	public function getRegister()
	{
		$this->view('panel.pages.auth.register');
	}

	/**
	 *
	 */
	public function postRegister()
	{
		$input = Input::only(
			'email',
			'first_name',
			'last_name',
			'password',
			'password_confirmation',
			'mobile'
		);

		try {
			$this->reg->directRegister(
				$input,
				['authenticated','customer']
			);
			return $this->redirectTo('auth/login')
				        ->with('success_message','حساب کاربری شما با موفقیت ایجاد شد.  میتوانید از قسمت زیر وارد شوید.');
		}catch (RegisterNeedException $e)
		{
			return $this->redirectTo('auth/register')
						->withErrors($this->reg->getErrors())
						->withInput();
		}catch(UserExistsException $e)
		{
			return $this->redirectTo('auth/register')
						->with('error_message','کاربر با این ایمیل وجود دارد.')
						->withInput();
		}
	}

    /**
     * Log out the user
     *
     * @return Redirect
     */
    public function getLogout()
    {
        $this->auth->logout();
        return $this->redirectTo('auth/login')->with(
                'success_message',
                Lang::get('messages.panel_logout')
         );
    }


}