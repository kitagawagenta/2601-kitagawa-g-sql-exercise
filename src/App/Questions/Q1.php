<?php

namespace App\Questions;

use PDO;

class Q1 extends BaseQuestion
{
<<<<<<< feature/4
    public function execute(): void
    {
        $host   = $_ENV['DB_HOST'] ?? 'mysql';
        $port   = $_ENV['DB_PORT'] ?? '3306';
        $dbname = $_ENV['DB_NAME'] ?? 'training';
        $user   = $_ENV['DB_USER'] ?? 'app';
        $pass   = $_ENV['DB_PASS'] ?? 'secret';

        // 2. データベース接続
        $dsn = "mysql:host={$host};port={$port};dbname={$dbname};charset=utf8mb4";
        $pdo = new PDO($dsn, $user, $pass);

        // 3. データ取得
        $stmt = $pdo->query('SELECT * FROM employees');
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $output = "";
        foreach ($rows as $row) {
            $line = implode(', ', $row) . "\n";
            echo $line;    
            $output .= $line; 
        }

        file_put_contents('answer_q1.txt', $output);
        
        echo "\n[OK] answer_q1.txt に結果を保存しました\n";
=======
public function execute(): void
{
    $tables = ['departments', 'employees', 'tasks'];

    foreach ($tables as $table) {
        $this->queryAndDisplay("SELECT * FROM {$table}", $table);
        echo "\n";
>>>>>>> local
    }
}
}