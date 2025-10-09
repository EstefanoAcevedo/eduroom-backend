<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Response;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'role' => \Spatie\Permission\Middleware\RoleMiddleware::class,
            'permission' => \Spatie\Permission\Middleware\PermissionMiddleware::class,
            'role_or_permission' => \Spatie\Permission\Middleware\RoleOrPermissionMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->respond(function ($e) {
            if ($e instanceof Response) {
                $status = $e->getStatusCode();
                switch ($status) {
                    case 403:
                        return response()->json(['message' => 'Acceso denegado. No tienes permisos suficientes.'], 403);
                        break;
                    case 404:
                        return response()->json(['message' => 'Ruta no encontrada.'], 404);
                        break;
                    case 500:
                        return response()->json(['message' => 'Error interno del servidor. Verifique que exista un token válido.'], 500);
                        break;
                    default:
                        return response()->json(['message' => 'Ocurrió un error inesperado.'], $status);
                        break;
                }
            }
            return null;
        });
    })->create();