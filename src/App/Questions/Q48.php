<?php

namespace App\Questions;

use PDO;

class Q48 extends BaseQuestion
{
    public function execute(): void
    {
        $pdo = $this->getPdo();

        $sql = "
            SELECT id, department_id, name, salary
            FROM employees
            WHERE salary > ALL (
                SELECT salary
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
