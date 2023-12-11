<?php

namespace LaravelHtmx\UserRegistration;
use Illuminate\Support\ServiceProvider;
class UsersServiceProvider extends ServiceProvider
{
	public function boot()
	{
		$this->loadRoutesFrom(__DIR__.'/routes.php');
		$this->loadViewsFrom(__DIR__.'/views', 'user-registration');
	}

	public function register()
	{
		// Register bindings, if any
	}
}