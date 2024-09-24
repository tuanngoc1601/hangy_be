<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MakeService extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:service {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Init new service for controller';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->argument('name');
        $path = app_path("Services/{$name}.php");

        // Check service file existed
        if (File::exists($path)) {
            $this->error("Service '{$name}' is existed!");
            return;
        }

        // Init content default service file
        $stub = "<?php

            namespace App\Services;

            class {$name}
            {
                // handle services
            }";

        // create service folder if not exists
        if (!File::isDirectory(app_path('Services'))) {
            File::makeDirectory(app_path('Services'));
        }

        // create service file
        File::put($path, $stub);

        $this->info("Service '{$name}' is created successfully!");
    }
}
