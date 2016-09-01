<?php

namespace Hesto\Adminlte\Commands;

use Hesto\Core\Commands\InstallCommand;
use Symfony\Component\Console\Input\InputOption;
use SplFileInfo;


class AdminlteInstallCommand extends InstallCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'adminlte:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install Admin LTE into Laravel 5 project';

    /**
     * Execute the console command.
     *
     * @return bool|null
     */
    public function fire()
    {
        $this->installResourcesFiles();
        $this->copyGulpFile();
    }

    /**
     * Copy all assets files to base assets folder path
     *
     */
    public function installResourcesFiles()
    {
        $assetsFiles = $this->files->allFiles(__DIR__ . '/../../resources/');
        $this->copyFiles('/resources/', $assetsFiles);
    }

    /**
     * Copy gulpfile.js to project's base path.
     *
     * @return bool
     */
    public function copyGulpFile()
    {
        $gulpfile = new SplFileInfo(__DIR__ . '/../../resources/gulpfile.js');
        $path = base_path() . '/gulpfile.js';

        if($this->putFile($path, $gulpfile)) {
            $this->info('Installed: ' . $path);
        }
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['force', 'f', InputOption::VALUE_NONE, 'Force override existing files'],
        ];
    }
}
