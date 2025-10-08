<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MakeServiceCommand extends Command
{
    protected $signature = 'make:service {name}';
    protected $description = 'Create a service class following the clean architecture pattern';

    public function handle()
    {
        $name = $this->argument('name');
        $servicePath = app_path("Services/{$name}Service.php");

        // Ensure directory exists
        if (!File::exists(app_path('Services'))) {
            File::makeDirectory(app_path('Services'), 0755, true);
        }

        // Create the service file
        if (!File::exists($servicePath)) {
            File::put($servicePath, $this->getTemplate($name));
            $this->info("✅ Created: {$servicePath}");
        } else {
            $this->warn("⚠️ Service already exists: {$servicePath}");
        }
    }

    protected function getTemplate($name)
    {
        return <<<PHP
<?php

namespace App\Services;

use App\Repositories\\{$name}Repository;

class {$name}Service
{
    public function __construct(
        protected {$name}Repository \$repository
    ) {}

    public function getAll()
    {
        return \$this->repository->all();
    }

    public function getById(\$id)
    {
        return \$this->repository->find(\$id);
    }

    public function create(array \$data)
    {
        return \$this->repository->create(\$data);
    }
}
PHP;
    }
}
