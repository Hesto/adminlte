<?php

namespace Hesto\Adminlte\Commands;

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
        $this->copyBowerFiles();
        $this->copyAssetsFiles();
        $this->copyGulpFile();
    }

    /**
     * Copy bower files to project's base path.
     *
     */
    public function copyBowerFiles()
    {
        $bowerFiles = $this->files->allFiles(__DIR__ . '/../../resources/bower/');

        //manually added because allFiles method ignore dot files
        $bowerFiles[] = new SplFileInfo(__DIR__ . '/../../resources/bower/.bowerrc');

        $this->copyFiles('/', $bowerFiles);
    }

    /**
     * Copy all assets files to base assets folder path
     *
     */
    public function copyAssetsFiles()
    {
        $assetsFiles = $this->files->allFiles(__DIR__ . '/../../resources/assets/');
        $this->copyFiles('/resources/assets/', $assetsFiles);
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

        $this->putFile($path, $gulpfile);
    }
}
