<?php

namespace App\Questions;

use PDO;

class Q3
{
    public function execute(): void
    {
        $pdo = new PDO(
            "mysql:host=mysql;dbname=training;charset=utf8mb4",
            "app",
            "secret"
        );

        $sql = "
        INSERT INTO tasks (id, employee_id, is_done, expires_at, created_at)
        VALUES (5, 1, TRUE, '2024-01-16 18:00:00', '2024-01-13 09:00:00')
        ";

        $pdo->exec($sql);

        $stmt = $pdo->query("SELECT * FROM tasks");
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo "| id | employee_id | is_done | expires_at | created_at |\n";
        echo "|----|------------|---------|------------|------------|\n";

        foreach ($rows as $row) {
            $expiresAt = $row['expires_at'] === null ? 'NULL' : $row['expires_at'];

            echo "| {$row['id']} | {$row['employee_id']} | {$row['is_done']} | {$expiresAt} | {$row['created_at']} |\n";
        }
    }
}