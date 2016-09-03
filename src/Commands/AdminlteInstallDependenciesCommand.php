<?php

namespace Hesto\Adminlte\Commands;

use Hesto\Core\Commands\InstallContentCommand;

class AdminlteInstallDependenciesCommand extends InstallContentCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'adminlte:dependencies';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install npm dependencies';

    /**
     * Get settings array.
     *
     * @return string
     */
    public function getSettings()
    {
        return [
            'package_json' => [
                'path' => '/package.json',
                'search' => '"devDependencies": {',
                'stub' => __DIR__ . '/../stubs/npm/package.json.stub.',
                'prefix' => false,
            ],
        ];
    }
}
