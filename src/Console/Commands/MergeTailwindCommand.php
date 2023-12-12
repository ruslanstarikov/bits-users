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
		if(!file_exists($userTailwindConfig)) {
			File::copy($packageTailwindConfig, $userTailwindConfig);
		}
		else
		{
			$replaceTailwindQuestion = $this->ask('Do you want to replace your tailwind.config.js file? (y/n)');
			if($replaceTailwindQuestion == 'y')
			{
				File::copy($packageTailwindConfig, $userTailwindConfig);
			}
			else
			{
				$this->info("You will need to manually add the following plugins to your tailwind.conf.js");
				$this->info("[require('@tailwindcss/forms'), require('@tailwindcss/typography'), require('@tailwindcss/aspect-ratio')]");
			}
		}

		$this->info("Configuration complete. Now run npm install && npm run dev");
	}

	private function mergePackageJson(string $libPackageJsonFilePath, string $userPackageJsonFilePath)
	{
		$userPackageArray =  json_decode(File::get($userPackageJsonFilePath), true);
		$packagePackageArray = json_decode(File::get($libPackageJsonFilePath), true);
		$userPackageDependencies = $userPackageArray['devDependencies'] ?? [];
		$packagePackageDependencies = $packagePackageArray['devDependencies'] ?? [];
		$mergedDependencies = array_merge($userPackageDependencies, $packagePackageDependencies);

		$finalPackageJson = $userPackageArray;
		$finalPackageJson['devDependencies'] = $mergedDependencies;
		File::put($userPackageJsonFilePath, json_encode($finalPackageJson, JSON_PRETTY_PRINT));
	}
}
