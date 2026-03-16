<?php

namespace App\Questions;

use PDO;

class Q2
{
    public function execute(): void
    {
        $host   = $_ENV['DB_HOST'] ?? 'mysql';
        $port   = $_ENV['DB_PORT'] ?? '3306';
        $dbname = $_ENV['DB_NAME'] ?? 'training';
        $user   = $_ENV['DB_USER'] ?? 'app';
        $pass   = $_ENV['DB_PASS'] ?? 'secret';

        $dsn = "mysql:host={$host};port={$port};dbname={$dbname};charset=utf8mb4";
        $pdo = new PDO($dsn, $user, $pass);

        // 1. DELETE文の定義と実行
        $deleteSql = "DELETE FROM departments WHERE id = 3;";
        $pdo->exec($deleteSql);

        // 2. 結果確認用SELECT文の定義と実行
        $selectSql = "SELECT * FROM departments;";
        $stmt = $pdo->query($selectSql);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // 3. 出力処理
        $output = "--- Q2: departments ---\n";
        if (!empty($rows)) {
            $columns = array_keys($rows[0]);
            
            // ヘッダー行
            $output .= "|" . implode("|", $columns) . "|\n";
            // 区切り線
            $output .= "|" . implode("|", array_fill(0, count($columns), "---")) . "|\n";
            
            // データ行
            foreach ($rows as $row) {
                $output .= "|" . implode("|", $row) . "|\n";
            }
        }

        echo $output;
        file_put_contents('answer_q2.txt', $output);
        
        echo "\n[OK] answer_q2.txt に結果を保存しました\n";
    }
}