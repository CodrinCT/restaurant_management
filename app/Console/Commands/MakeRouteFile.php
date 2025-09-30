<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MakeRouteFile extends Command
{
    protected $signature = 'make:route {name}';
    protected $description = 'Create a new route file in routes/';

    public function handle()
    {
        $name = strtolower($this->argument('name'));
        $path = base_path("routes/{$name}.php");

        if (File::exists($path)) {
            $this->error("Route file {$name}.php already exists!");
            return;
        }

        File::put($path, "<?php\n\nuse Illuminate\\Support\\Facades\\Route;\n\n");

        $this->info("Route file {$name}.php created successfully.");
    }
}
