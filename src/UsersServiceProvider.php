<?php

namespace LaravelHtmx\UserRegistration;
use Illuminate\Foundation\Mix;
use Illuminate\Support\ServiceProvider;
use LaravelHtmx\UserRegistration\Console\Commands\MergeTailwindCommand;

class UsersServiceProvider extends ServiceProvider
{
	public function boot()
	{
		$this->loadRoutesFrom(__DIR__.'/routes.php');
		$this->loadViewsFrom(__DIR__.'/views', 'user-registration');
		$this->commands([
			MergeTailwindCommand::class,
		]);
		if ($this->app->runningInConsole()) {
			$this->publishes([
				__DIR__.'/views' => resource_path('views/vendor/user-registration'),
			], 'user-registration-views');
		}
		$this->publishCss();
	}

	private function publishCss()
	{
		$cssFilePath = __DIR__.'/resources/css/package.css';
		$laravelDestination = resource_path('css/package.css');
		$this->publishes([
			$cssFilePath => $laravelDestination,
		], 'public');
	}

	public function register()
	{
		// Register bindings, if any
	}
}