<?php

namespace App;

use PDO;

class Connection
{
    public static function getPdo(): PDO
    {
        $host   = $_ENV['DB_HOST'] ?? 'mysql';
        $port   = $_ENV['DB_PORT'] ?? '3306';
        $dbname = $_ENV['DB_NAME'] ?? 'training';
        $user   = $_ENV['DB_USER'] ?? 'app';
        $pass   = $_ENV['DB_PASS'] ?? 'secret';

        $dsn = "mysql:host={$host};port={$port};dbname={$dbname};charset=utf8mb4";

        return new PDO($dsn, $user, $pass, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]);
    }
}