<?php

require_once __DIR__ . '/vendor/autoload.php';

$arg = $argv[1] ?? null;

if ($arg === '--setup') {
    $pdo = connectDb();

    $pdo->exec('DROP TABLE IF EXISTS tasks');
    $pdo->exec('DROP TABLE IF EXISTS employees');
    $pdo->exec('DROP TABLE IF EXISTS departments');

    $pdo->exec('CREATE TABLE departments (
        id   INT PRIMARY KEY NOT NULL,
        name VARCHAR(100) NOT NULL
    )');

    $pdo->exec('CREATE TABLE employees (
        id            INT PRIMARY KEY NOT NULL,
        department_id INT NOT NULL,
        name          VARCHAR(100) NOT NULL,
        salary        INT NOT NULL
    )');

    $pdo->exec('CREATE TABLE tasks (
        id          INT PRIMARY KEY NOT NULL,
        employee_id INT NOT NULL,
        is_done     BOOLEAN NOT NULL,
        expires_at  DATETIME,
        created_at  DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
    )');

    $pdo->exec("INSERT INTO departments VALUES
    (1, 'Sales'),
    (2, 'Engineering'),
    (3, 'HR')
    ");

    $pdo->exec("INSERT INTO employees VALUES
    (1, 1, 'Alice', 350000),
    (2, 1, 'Bob', 280000),
    (3, 2, 'Carol', 420000),
    (4, 3, 'Dave', 310000)
    ");

    $pdo->exec("INSERT INTO tasks VALUES
    (1, 1, TRUE,  '2024-01-15 18:00:00', '2024-01-10 09:00:00'),
    (2, 2, FALSE, NULL,                  '2024-01-10 10:00:00'),
    (3, 4, FALSE, '2024-01-14 18:00:00', '2024-01-11 09:00:00'),
    (4, 4, TRUE,  NULL,                  '2024-01-12 09:00:00')
    ");

    echo "セットアップが完了しました。\n";
    exit;
}

if ($arg !== null) {
    $class = "App\\Questions\\Q{$arg}";
    if (!class_exists($class)) {
        echo "Q{$arg} は存在しません\n";
        exit(1);
    }
    echo "=== Q{$arg} ===\n";
    (new $class())->execute();
} else {
    for ($i = 1; $i <= 58; $i++) {
        $class = "App\\Questions\\Q{$i}";
        if (class_exists($class)) {
            echo "=== Q{$i} ===\n";
            (new $class())->execute();
        }
    }
}

function connectDb(): PDO
{
    $host   = $_ENV['DB_HOST'] ?? 'localhost';
    $port   = $_ENV['DB_PORT'] ?? '3306';
    $dbname = $_ENV['DB_NAME'] ?? 'training';
    $user   = $_ENV['DB_USER'] ?? 'app';
    $pass   = $_ENV['DB_PASS'] ?? '';

    $dsn = "mysql:host={$host};port={$port};dbname={$dbname};charset=utf8mb4";

    return new PDO($dsn, $user, $pass, [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);
}