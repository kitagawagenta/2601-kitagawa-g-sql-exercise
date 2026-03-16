<?php

namespace App\Questions;

use PDO;

class Q1
{
    public function execute(): void
    {
        // 1. 接続設定
        $host   = $_ENV['DB_HOST'] ?? 'mysql';
        $port   = $_ENV['DB_PORT'] ?? '3306';
        $dbname = $_ENV['DB_NAME'] ?? 'training';
        $user   = $_ENV['DB_USER'] ?? 'app';
        $pass   = $_ENV['DB_PASS'] ?? 'secret';

        $dsn = "mysql:host={$host};port={$port};dbname={$dbname};charset=utf8mb4";
        $pdo = new PDO($dsn, $user, $pass);

        // 2. 出力対象のテーブル定義
        $tables = ['departments', 'employees', 'tasks'];
        $output = "";

        foreach ($tables as $table) {
            $output .= "--- {$table} ---\n";
            
            // 各テーブルの全レコード取得
            $stmt = $pdo->query("SELECT * FROM {$table}");
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if (!empty($rows)) {
                $columns = array_keys($rows[0]);

                $header = "|" . implode("|", $columns) . "|\n";
                $separator = "|" . implode("|", array_fill(0, count($columns),"---")) . "/\n";
                $output .= $header . $separator;
                echo $header . $separator;
                    

                // データ行の出力
                foreach ($rows as $row) {
                    $line = implode(', ', $row) . "\n";
                    echo $line;    
                    $output .= $line; 
                }
            }
            $output .= "\n";
            echo "\n";
        }

        // 3. 結果をファイルへ保存
        file_put_contents('answer_q1.txt', $output);
        
        echo "[OK] answer_q1.txt に結果を保存しました\n";
    }
}