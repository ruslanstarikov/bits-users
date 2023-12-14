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
		$sourceTailwindConfig = __DIR__.'/../../configs/tailwind.config.js';
		$sourcePackageJsonConfig = __DIR__.'/../../configs/package.json';
		$sourcePostCssConfig = __DIR__.'/../../configs/postcss.config.js';

		$targetTailwind = base_path('tailwind.config.js');
		$targetPackageJson = base_path('package.json');
		$targetPostCssConfig = base_path('postcss.config.js');
		$this->mergePackageJson($sourcePackageJsonConfig, $targetPackageJson);

		$tailwindInstruction = "You will need to manually add the following plugins to your tailwind.conf.js\n[require('@tailwindcss/forms'), require('@tailwindcss/typography'), require('@tailwindcss/aspect-ratio')]";

		$this->mergeFilePrompt($sourceTailwindConfig, $targetTailwind, $tailwindInstruction);
		$this->mergeFilePrompt($sourcePostCssConfig, $targetPostCssConfig);
		$this->info("Configuration complete. Now run npm install && npm run dev");
	}

	private function mergeFilePrompt(string $sourceFile, string $targetFile, string $instruction = null)
	{
		if(!file_exists($targetFile)) {
			File::copy($sourceFile, $targetFile);
		}
		else
		{
			$replaceFileQuestion = $this->ask('Do you want to replace your '.$targetFile.' file? (y/n)');
			if($replaceFileQuestion == 'y')
			{
				File::copy($sourceFile, $targetFile);
			}
		}
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
