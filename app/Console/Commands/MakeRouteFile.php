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
        // Get argument as passed (can contain subfolders)
        $name = $this->argument('name');

        // Full path (inside routes folder)
        $path = base_path("routes/{$name}.php");

        // Ensure folder exists
        $directory = dirname($path);
        if (!File::isDirectory($directory)) {
            File::makeDirectory($directory, 0755, true); // recursive = true
            $this->info("Created directory: {$directory}");
        }

        // Check if file already exists
        if (File::exists($path)) {
            $this->error("Route file {$name}.php already exists!");
            return;
        }

        // Create the file
        File::put($path, "<?php\n\nuse Illuminate\\Support\\Facades\\Route;\n\n");

        $this->info("Route file {$name}.php created successfully.");
    }
}
