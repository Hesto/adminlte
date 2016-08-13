<?php

namespace Hesto\Adminlte\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use SplFileInfo;
use Symfony\Component\Console\Input\InputOption;


class AdminlteInstallCommand extends Command
{
    /**
     * The filesystem instance.
     *
     * @var \Illuminate\Filesystem\Filesystem
     */
    protected $files;

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
     * Create a new controller creator command instance.
     *
     * @param  \Illuminate\Filesystem\Filesystem  $files
     * @return void
     */
    public function __construct(Filesystem $files)
    {
        parent::__construct();

        $this->files = $files;
    }

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
     * Copy files method.
     *
     * @param $path
     * @param $files
     */
    public function copyFiles($path, $files)
    {
        foreach($files as $file)
        {
            $name = $file->getFileName();

            if(empty($name)) {
                $name = $file->getExtension();
            }

            $filepath = base_path(). $path . $name;

            if($this->alreadyExists($filepath) && !$this->option('force')) {
                $this->error($filepath . ' already exists!');

                continue;
            }

            $this->makeDirectory($filepath);

            $this->files->put($filepath, $this->files->get($file->getPathname()));

            $this->info('Copied: ' . $filepath);
        }
    }

    /**
     * Determine if the class already exists.
     *
     * @param $path
     * @return bool
     */
    protected function alreadyExists($path)
    {
        return $this->files->exists($path);
    }

    /**
     * Build the directory for the class if necessary.
     *
     * @param  string  $path
     * @return string
     */
    protected function makeDirectory($path)
    {
        if (! $this->files->isDirectory(dirname($path))) {
            $this->files->makeDirectory(dirname($path), 0777, true, true);
        }
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
        $gulpfile = __DIR__ . '/../../resources/gulpfile.js';
        $path = base_path() . '/gulpfile.js';

        if($this->alreadyExists($path) && !$this->option('force')) {
            $this->error($path . ' already exists!');

            return false;
        }

        $this->files->put($path, $this->files->get($gulpfile));
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
