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
		$packageTailwindConfig = __DIR__.'../../configs/tailwind.config.js';
		$packagePackageJson = __DIR__.'../../configs/package.json';

		$userTailwindConfig = base_path('tailwind.config.js');
		$userPackageJson = base_path('package.json');

		$mergedTailwindConfig = array_merge(
			require($packageTailwindConfig),
			require($userTailwindConfig)
		);
		$mergedPackageJson = array_merge(
			json_decode(File::get($packagePackageJson), true),
			json_decode(File::get($userPackageJson), true)
		);
		File::put($userTailwindConfig, 'module.exports = '.var_export($mergedTailwindConfig, true).";\n");
		File::put($userPackageJson, json_encode($mergedPackageJson, JSON_PRETTY_PRINT));

		$this->info('Tailwind CSS and package.json files merged successfully.');
	}
}
