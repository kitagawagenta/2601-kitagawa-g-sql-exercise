<?php

require_once __DIR__ . '/vendor/autoload.php';

use App\Connection;

$arg = $argv[1] ?? null;

if ($arg === '--setup') {
    try {
        $pdo = Connection::getPdo();

        $pdo->exec('DROP TABLE IF EXISTS tasks');
        $pdo->exec('DROP TABLE IF EXISTS employees');
        $pdo->exec('DROP TABLE IF EXISTS departments');

        $pdo->exec('CREATE TABLE departments (
            id   INT PRIMARY KEY AUTO_INCREMENT,
            name VARCHAR(100) NOT NULL
        )');

        $pdo->exec('CREATE TABLE employees (
            id            INT PRIMARY KEY AUTO_INCREMENT,
            name          VARCHAR(100) NOT NULL,
            department_id INT,
            salary        INT NOT NULL
        )');

        $pdo->exec('CREATE TABLE tasks (
            id          INT PRIMARY KEY AUTO_INCREMENT,
            employee_id INT NOT NULL,
            is_done     BOOLEAN NOT NULL DEFAULT FALSE,
            expires_at  DATETIME,
            created_at  DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
        )');

        $pdo->exec("INSERT INTO departments VALUES
            (1, 'Sales'),
            (2, 'Engineering'),
            (3, ''),
            (4, 'Marketing')");



        $pdo->exec("INSERT INTO employees (name, department_id, salary) VALUES
            ('Alice', 1, 350000),
            ('Bob',   1, 280000),
            ('Carol', 2, 420000),
            ('Dave',  3, 310000),
            ('Eve',   5, 380000)");


        $pdo->exec("INSERT INTO tasks (employee_id, is_done, expires_at, created_at) VALUES
    (1, TRUE,  '2024-01-15 18:00:00', '2024-01-10 09:00:00'),
    (2, FALSE, NULL,                  '2024-01-10 10:00:00'),
    (4, FALSE, '2024-01-14 18:00:00', '2024-01-11 09:00:00'),
    (4, TRUE,  NULL,                  '2024-01-12 09:00:00'),
    (1, TRUE,  '2024-01-16 18:00:00', '2024-01-13 09:00:00')");


        echo "セットアップが完了しました。\n";
        exit;
    } catch (PDOException $e) {
        fwrite(STDERR, $e->getMessage() . PHP_EOL);
        exit(1);
    }
}

if ($arg !== null) {
    $class = "App\\Questions\\Q{$arg}";

    if (!class_exists($class)) {
        echo "Q{$arg} は存在しません\n";
        exit(1);
    }

    try {
        (new $class())->execute();
    } catch (PDOException $e) {
        fwrite(STDERR, $e->getMessage() . PHP_EOL);
        exit(1);
    }

    exit;
}

for ($i = 1; $i <= 58; $i++) {
    $class = "App\\Questions\\Q{$i}";

    if (class_exists($class)) {
        try {
            (new $class())->execute();
            echo "\n";
        } catch (PDOException $e) {
            fwrite(STDERR, $e->getMessage() . PHP_EOL);
            exit(1);
        }
    }
}
