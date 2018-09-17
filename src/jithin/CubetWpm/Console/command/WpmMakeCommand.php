<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Console\DetectsApplicationNamespace;

class WpmMakeCommand extends Command
{
    use DetectsApplicationNamespace;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:wpm
                    {--views : Only scaffold the wpm views}
                    {--force : Overwrite existing views by default}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Scaffold wpm controllers, views and routes';

    /**
     * The views that need to be exported.
     *
     * @var array
     */
    protected $views = [
        'wpm/admin/wpm-list.stub' => 'wpm/admin/wpm-list.blade.php',
        'wpm/admin/wpm-add.stub' => 'wpm/admin/wpm-add.blade.php',
        'wpm/admin/wpm-view.stub' => 'wpm/admin/wpm-view.blade.php',
        'wpm/admin/wpm-edit.stub' => 'wpm/admin/wpm-edit.blade.php',
        'wpm/static.stub' => 'wpm/static.blade.php',

    ];

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $this->createDirectories();

        $this->exportViews();

        if (!$this->option('views')) {
            $this->exportControllers();
            file_put_contents(
                base_path('routes/web.php'),
                file_get_contents(base_path('vendor/jithin/cubet-wpm/src/jithin/CubetWpm/Console/stubs/make') . '/routes.stub'),
                FILE_APPEND
            );
        }

        $this->info('WPM scaffolding generated successfully.');
    }

    /**
     * Create the directories for the files.
     *
     * @return void
     */
    protected function createDirectories()
    {
        if (!is_dir($directory = app_path('Http/Controllers/Admin'))) {
            mkdir($directory, 0755, true);
        }

        if (!is_dir($directory = resource_path('views/wpm/admin'))) {
            mkdir($directory, 0755, true);
        }
    }

    /**
     * Export the wpm views.
     *
     * @return void
     */
    protected function exportViews()
    {
        foreach ($this->views as $key => $value) {
            if (file_exists($view = resource_path('views/' . $value)) && !$this->option('force')) {
                if (!$this->confirm("The [{$value}] view already exists. Do you want to replace it?")) {
                    continue;
                }
            }

            copy(
                base_path('vendor/jithin/cubet-wpm/src/jithin/CubetWpm/Console/stubs/make/views/') . $key,
                $view
            );
        }
    }

    /**
     * Export the wpm controllers.
     *
     * @return void
     */
    protected function exportControllers()
    {
        if (file_exists($controller = app_path('Http/Controllers/Admin/WpmController.php')) && !$this->option('force')) {
            if (!$this->confirm("The [WpmController.php] controller already exists. Do you want to replace it?")) {
                return;
            }
        }

        file_put_contents(
            $controller,
            $this->compileControllerStub()
        );
    }

    /**
     * Compiles the WpmController stub.
     *
     * @return string
     */
    protected function compileControllerStub()
    {
        return str_replace(
            '{{namespace}}',
            $this->getAppNamespace(),
            file_get_contents(base_path('vendor/jithin/cubet-wpm/src/jithin/CubetWpm/Console/stubs/make/controllers/Admin') . '/WpmController.stub')
        );
    }
}
