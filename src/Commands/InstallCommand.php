<?php

namespace Hesto\Adminlte\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Symfony\Component\Console\Input\InputOption;


abstract class InstallCommand extends Command
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
    protected $name;

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description;

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
    abstract function fire();

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
