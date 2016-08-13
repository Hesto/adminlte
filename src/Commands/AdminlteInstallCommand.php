<?php

namespace Hesto\Adminlte\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;

class ViewMakeCommand extends Command
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

    public function copyBowerFiles()
    {
        $bowerFiles = $this->files->allFiles(__DIR__ . '/../../resources/bower/');
        $this->copyFiles('/', $bowerFiles);
    }

    public function copyFiles($path, $files)
    {
        foreach($files as $file)
        {
            $filepath = base_path(). $path . $file->getFileName();

            if($this->alreadyExists($path) && !$this->option('force')) {
                $this->error($path . ' already exists!');

                continue;
            }

            $this->makeDirectory($filepath);

            $this->files->put($filepath, $file->getPathname());
        }
    }

    protected function alreadyExists($path)
    {
        return $this->files->exists($path);
    }

    public function copyAssetsFiles()
    {
        $assetsFiles = $this->files->allFiles(__DIR__ . '/../../resources/assets/');
        $this->copyFiles('/resources/assets/', $assetsFiles);
    }

    public function copyGulpFile()
    {
        $this->files->put(base_path() . '/gulpfile.js', _DIR__ . '/../../resources/gulpfile.js');
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['force', 'f', InputOption::VALUE_OPTIONAL, 'Force override existing files', true],
        ];
    }
}
