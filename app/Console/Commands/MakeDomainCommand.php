<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MakeDomainCommand extends Command
{
    protected $signature = 'make:domain {name : The name of the domain (e.g. WorkOrders)}';
    protected $description = 'Scaffold a new domain folder structure with a model, service, and controller.';

    public function handle(): void
    {
        $name = trim($this->argument('name'));
        $singular = str()->singular($name);
        $domainPath = app_path("Domain/{$name}");

        if (File::exists($domainPath)) {
            $this->error("Domain '{$name}' already exists!");
            return;
        }

        // 1️⃣ Create base folders
        $folders = [
            'Models',
            'Requests',
            'Services',
            'Repositories',
            'Actions',
            'Resources',
            'Providers',
            'Http/Controllers',
        ];

        foreach ($folders as $folder) {
            File::ensureDirectoryExists("{$domainPath}/{$folder}");
        }

        // 2️⃣ Create the Model
        $modelTemplate = <<<PHP
<?php

namespace App\\Domain\\{$name}\\Models;

use Illuminate\\Database\\Eloquent\\Factories\\HasFactory;
use Illuminate\\Database\\Eloquent\\Model;

class {$singular} extends Model
{
    use HasFactory;

    protected \$guarded = [];
}
PHP;
        File::put("{$domainPath}/Models/{$singular}.php", $modelTemplate);

        // 3️⃣ Create the Service
        $serviceTemplate = <<<PHP
<?php

namespace App\\Domain\\{$name}\\Services;

use App\\Domain\\{$name}\\Models\\{$singular};

class {$singular}Service
{
    public function all()
    {
        return {$singular}::all();
    }

    public function create(array \$data)
    {
        return {$singular}::create(\$data);
    }
}
PHP;
        File::put("{$domainPath}/Services/{$singular}Service.php", $serviceTemplate);

        // 4️⃣ Create the Controller
        $controllerTemplate = <<<PHP
<?php

namespace App\\Domain\\{$name}\\Http\\Controllers;

use App\\Http\\Controllers\\Controller;
use App\\Domain\\{$name}\\Services\\{$singular}Service;
use Illuminate\\Http\\Request;

class {$singular}Controller extends Controller
{
    public function __construct(protected {$singular}Service \$service) {}

    public function index()
    {
        return inertia('{$name}/Index', [
            'items' => \$this->service->all()
        ]);
    }

    public function store(Request \$request)
    {
        \$this->service->create(\$request->all());
        return back();
    }
}
PHP;
        File::put("{$domainPath}/Http/Controllers/{$singular}Controller.php", $controllerTemplate);

        // 5️⃣ Create the ServiceProvider
        $providerTemplate = <<<PHP
<?php

namespace App\\Domain\\{$name}\\Providers;

use Illuminate\\Support\\ServiceProvider;

class {$name}ServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // Bind {$name} services here
    }

    public function boot(): void
    {
        // Bootstrap {$name} domain features
    }
}
PHP;
        File::put("{$domainPath}/Providers/{$name}ServiceProvider.php", $providerTemplate);

        // 6️⃣ Output summary
        $this->components->info("✅ Domain '{$name}' created successfully!");
        $this->components->twoColumnDetail('Location', "app/Domain/{$name}");
        $this->components->twoColumnDetail('Includes', 'Model, Service, Controller, and Provider');
        $this->newLine();
        $this->components->info("🎉 Ready to code your {$name} domain!");
    }
}
