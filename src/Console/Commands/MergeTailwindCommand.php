<?php

namespace LaravelHtmx\UserRegistration\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MergeTailwindCommand extends Command
{
    protected $signature = 'bits-laravel-htmx:merge-tailwind';

    protected $description = 'Will add necessary plugins to the tailwind installation and packages.json';

    public function handle()
    {
		$packageTailwindConfig = __DIR__.'/../../configs/tailwind.config.js';
		$packagePackageJson = __DIR__.'/../../configs/package.json';

		$userTailwindConfig = base_path('tailwind.config.js');
		$userPackageJson = base_path('package.json');

		$this->mergePackageJson($packagePackageJson, $userPackageJson);

		$this->info('Tailwind CSS and package.json files merged successfully.');
	}

	private function mergePackageJson(string $packagePackageJson, string $userPackageJson)
	{
		$mergedPackageJson = array_merge(
			json_decode(File::get($packagePackageJson), true),
			json_decode(File::get($userPackageJson), true)
		);
		File::put($userPackageJson, json_encode($mergedPackageJson, JSON_PRETTY_PRINT));
	}

	private function mergeTailwindConfig(string $packageTailwindConfigPath, string $userTailwindConfigPath)
	{
		$pluginsToAdd = [
			'@tailwindcss/forms',
			'@tailwindcss/typography',
			'@tailwindcss/aspect-ratio'
		];
		if (file_exists($userTailwindConfigPath)) {
			$userTailwindConfig = file_get_contents($userTailwindConfigPath);
			$contents = preg_replace('/^module.exports = /', '', $userTailwindConfig);
			$contents = rtrim(rtrim($contents, "\n"), ';');
			$config = json_decode($contents, true);
			if (!isset($config['plugins'])) {
				// If "plugins" key doesn't exist, add it with the plugins array
				$config['plugins'] = $pluginsToAdd;
			} else {
				// If "plugins" key exists, merge the desired plugins with the existing ones
				$config['plugins'] = array_merge($pluginsToAdd, $config['plugins']);
			}
			$this->info(json_encode($config, JSON_PRETTY_PRINT));
		}
	}
}
