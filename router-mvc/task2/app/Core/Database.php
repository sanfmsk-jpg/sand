<?php

namespace App\Core;

use PDO;
use PDOException;

class Database
{
    private static ?PDO $connection = null;

    public static function connection(): PDO
    {
        if (self::$connection === null) {
            $host = '127.0.0.1';
            $port = '8889';       // порт MySQL в MAMP по умолчанию — смотри Preferences → Ports
            $dbName = 'mvc_demo'; // имя базы, созданной в phpMyAdmin
            $user = 'root';
            $password = 'root';

            $dsn = "mysql:host={$host};port={$port};dbname={$dbName};charset=utf8mb4";

            try {
                self::$connection = new PDO($dsn, $user, $password, [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                ]);
            } catch (PDOException $e) {
                http_response_code(500);
                die('Ошибка подключения к базе данных: ' . $e->getMessage());
            }
        }

        return self::$connection;
    }
}
