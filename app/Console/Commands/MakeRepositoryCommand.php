<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MakeRepositoryCommand extends Command
{
    protected $signature = 'make:repository {name}';
    protected $description = 'Create a repository interface, implementation, and auto-bind it';

    public function handle()
    {
        $name = $this->argument('name');
        $interfacePath = app_path("Repositories/{$name}Repository.php");
        $implPath = app_path("Repositories/Eloquent/Eloquent{$name}Repository.php");
        $providerPath = app_path("Providers/RepositoryServiceProvider.php");

        // Make sure folders exist
        if (!File::exists(app_path('Repositories/Eloquent'))) {
            File::makeDirectory(app_path('Repositories/Eloquent'), 0755, true);
        }

        // 1️⃣ Create Interface
        if (!File::exists($interfacePath)) {
            File::put($interfacePath, $this->getInterfaceTemplate($name));
            $this->info("Created: {$interfacePath}");
        } else {
            $this->warn("Interface already exists: {$interfacePath}");
        }

        // 2️⃣ Create Implementation
        if (!File::exists($implPath)) {
            File::put($implPath, $this->getImplementationTemplate($name));
            $this->info("Created: {$implPath}");
        } else {
            $this->warn("Implementation already exists: {$implPath}");
        }

        // 3️⃣ Auto-bind in RepositoryServiceProvider
        if (File::exists($providerPath)) {
            $this->addBindingToProvider($providerPath, $name);
        } else {
            $this->warn("RepositoryServiceProvider not found. Please create it manually.");
        }

        $this->info("✅ Repository for {$name} created and bound!");
    }

    protected function getInterfaceTemplate($name)
    {
        return <<<PHP
<?php

namespace App\Repositories;

interface {$name}Repository
{
    public function all();
    public function find(\$id);
    public function create(array \$data);
}
PHP;
    }

    protected function getImplementationTemplate($name)
    {
        return <<<PHP
<?php

namespace App\Repositories\Eloquent;

use App\Models\\{$name};
use App\Repositories\\{$name}Repository;

class Eloquent{$name}Repository implements {$name}Repository
{
    public function all()
    {
        return {$name}::all();
    }

    public function find(\$id)
    {
        return {$name}::findOrFail(\$id);
    }

    public function create(array \$data)
    {
        return {$name}::create(\$data);
    }
}
PHP;
    }

    protected function addBindingToProvider(string $providerPath, string $name): void
    {
        $providerContent = File::get($providerPath);
        $bindingLine = "\$this->app->bind(\\App\\Repositories\\{$name}Repository::class, \\App\\Repositories\\Eloquent\\Eloquent{$name}Repository::class);";

        // Check if already bound
        if (str_contains($providerContent, $bindingLine)) {
            $this->warn("Binding for {$name}Repository already exists.");
            return;
        }

        // Insert binding inside register() method
        $updated = preg_replace(
            '/public function register\(\): void\s*\{\s*/',
            "public function register(): void\n    {\n        {$bindingLine}\n        ",
            $providerContent
        );

        if ($updated) {
            File::put($providerPath, $updated);
            $this->info("Auto-bound {$name}Repository in RepositoryServiceProvider!");
        } else {
            $this->warn("Could not insert binding — please add it manually.");
        }
    }
}
