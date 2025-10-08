<?php

use App\Http\Middleware\HandleAppearance;
use App\Http\Middleware\HandleInertiaRequests;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Middleware\AddLinkHeadersForPreloadedAssets;

// Build an array of all web route files (including subfolders)
$webRoutes = [__DIR__ . '/../routes/web.php'];

// Recursively load all .php files under routes/web/extra (example folder)
// You can change "routes/web" to any folder you want
$dir = new RecursiveDirectoryIterator(__DIR__ . '/../routes');
$iterator = new RecursiveIteratorIterator($dir);
foreach ($iterator as $file) {
    if ($file->isFile() && $file->getExtension() === 'php' && $file->getFilename() !== 'web.php' && $file->getFilename() !== 'console.php') {
        $webRoutes[] = $file->getPathname();
    }
}

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: $webRoutes,
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->encryptCookies(except: ['appearance', 'sidebar_state']);

        $middleware->web(append: [
            HandleAppearance::class,
            HandleInertiaRequests::class,
            AddLinkHeadersForPreloadedAssets::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
