<?php namespace SaleBoss\Services;
use Illuminate\Support\ServiceProvider;

class ServicesServiceProvider extends ServiceProvider {

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'SaleBoss\Services\Authenticator\AuthenticatorInterface',
            'SaleBoss\Services\Authenticator\SentryAuthenticator'
        );

    }
}