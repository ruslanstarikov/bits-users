<?php

namespace LaravelHtmx\UserRegistration;
use Illuminate\Support\ServiceProvider;
class UsersServiceProvider extends ServiceProvider
{
	public function boot()
	{
		$this->loadRoutesFrom(__DIR__.'/routes.php');
		$this->loadViewsFrom(__DIR__.'/views', 'user-registration');
		if ($this->app->runningInConsole()) {
			$this->publishes([
				__DIR__.'/views' => resource_path('views/vendor/user-registration'),
			], 'user-registration-views');
		}
	}

	public function register()
	{
		// Register bindings, if any
	}
}