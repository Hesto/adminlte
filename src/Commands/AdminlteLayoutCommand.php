<?php

namespace Hesto\Adminlte\Commands;

use Symfony\Component\Console\Input\InputArgument;


class AdminlteLayoutCommand extends InstallCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'adminlte:layout';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install default Admin LTE layout';

    /**
     * Execute the console command.
     *
     * @return bool|null
     */
    public function fire()
    {
        $this->copyLayoutFiles();
    }

    /**
     * Copy bower files to project's base path.
     *
     */
    public function copyLayoutFiles()
    {
        $files = $this->files->allFiles(__DIR__ . '/../../resources/layout/');

        $this->installFiles('/resources/views/' . $this->argument('name') . '/', $files);
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['name', InputArgument::REQUIRED, 'The name of the layout'],
        ];
    }
}
