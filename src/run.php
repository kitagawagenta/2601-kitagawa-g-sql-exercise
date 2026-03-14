<?php

require_once __DIR__ . '/vendor/autoload.php';

require_once __DIR__ . '/Connection.php';

use App\Connection;

$arg = $argv[1] ?? null;

// セットアップ処理（変更なし）
if ($arg === '--setup') {
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

    $pdo->exec("INSERT INTO departments VALUES (1, 'Sales'), (2, 'Engineering')");

    $pdo->exec("INSERT INTO employees (name, department_id, salary) VALUES
        ('Alice', 1, 350000),
        ('Bob',   1, 280000),
        ('Carol', 2, 420000),
        ('Dave',  2, 310000),
        ('Eve',   3, 290000)");

    $pdo->exec("INSERT INTO tasks (employee_id, is_done, expires_at, created_at) VALUES
        (1, FALSE, '2024-01-15 18:00:00', '2024-01-13 09:00:00'),
        (1, TRUE,  NULL,                  '2024-01-13 10:00:00'),
        (2, FALSE, '2024-01-20 18:00:00', '2024-01-14 09:00:00'),
        (3, TRUE,  '2024-01-18 18:00:00', '2024-01-14 11:00:00')");

    echo "セットアップが完了しました。\n";
    exit;
}

// クラスの実行処理
if ($arg !== null) {
    $class = "App\\Questions\\Q{$arg}";

    if (!class_exists($class)) {
        echo "Q{$arg} は存在しません\n";
        exit(1);
    }

    // 装飾（=== Q1 ===）を削除し、実行のみ行う
    (new $class())->execute();
} else {
    // 全問一括実行時も装飾を削除
    for ($i = 1; $i <= 58; $i++) {
        $class = "App\\Questions\\Q{$i}";
        if (class_exists($class)) {
            (new $class())->execute();
            echo "\n"; // 問題ごとの区切りに改行だけ入れる
        }
    }
<<<<<<< feature/4
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
=======
}
>>>>>>> local
