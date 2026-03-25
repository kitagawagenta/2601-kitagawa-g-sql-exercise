<?php

namespace App\Questions;

use PDO;

class Q43 extends BaseQuestion
{
    public function execute(): void
    {
        $pdo = $this->getPdo();

        $sql = "
            SELECT id, employee_id, is_done, expires_at, created_at
            FROM tasks
            WHERE employee_id IN （
                SELECT id
                FROM employees
            )
            ORDER BY id
        ";

        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $this->displayTable($rows);
    }
}


