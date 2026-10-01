<?php

declare(strict_types=1);

spl_autoload_register(function (string $class) {
    $prefix = 'App\\';
    $baseDir = __DIR__ . '/app/';

    if (!str_starts_with($class, $prefix)) return;

    $file = $baseDir . str_replace('\\', '/', substr($class, strlen($prefix))) . '.php';
    if (file_exists($file)) require $file;
});

use App\Core\Router;

$router = new Router();

// Пока — замыкания, контроллеров ещё нет
$router->get('/', fn() => print '<h1>Главная — список статей</h1>');
$router->get('/about', fn() => print '<h1>О проекте</h1>');
$router->get('/article/{id}', fn($id) => print "<h1>Статья №{$id}</h1>");

$router->dispatch($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);
