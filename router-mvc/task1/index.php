<?php

declare(strict_types=1);

// Что вообще пришло?
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = rtrim($uri, '/') ?: '/';

echo "<pre>";
echo "REQUEST_URI: {$_SERVER['REQUEST_URI']}\n";
echo "PATH:        {$uri}\n";
echo "METHOD:      {$_SERVER['REQUEST_METHOD']}\n";
echo "</pre>";

// Простейшая маршрутизация вручную
switch ($uri) {
    case '/':
        echo "<h1>Главная страница — список статей</h1>";
        break;

    case '/about':
        echo "<h1>О проекте</h1>";
        break;

    default:
        if (preg_match('#^/article/(\d+)$#', $uri, $m)) {
            echo "<h1>Статья №{$m[1]}</h1>";
        } else {
            http_response_code(404);
            echo "<h1>404 — страница не найдена</h1>";
        }
}
