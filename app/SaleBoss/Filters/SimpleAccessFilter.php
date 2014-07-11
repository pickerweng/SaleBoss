<?php namespace SaleBoss\Filters;

use Cartalyst\Sentry\Facades\Laravel\Sentry;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use SaleBoss\Services\Authenticator\AuthenticatorInterface;

class SimpleAccessFilter {

    public function __construct(AuthenticatorInterface $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Ensure user is logged in
     *
     * @return
     */
    public function auth (){
        if ( ! $this->auth->check() ){
            $redirect = '?redirect=' . urlencode(Request::path());
            return Redirect::to('/auth/login' . $redirect   )
                    ->with(
                        'error_message',
                        Lang::get('messages.login_access_denied')
                    );
        }
    }

    /**
     * Ensure user is guest
     *
     * @return
     */
    public function guest()
    {
        if ( $this->auth->check() )
            return Redirect::to('dash');
    }
}