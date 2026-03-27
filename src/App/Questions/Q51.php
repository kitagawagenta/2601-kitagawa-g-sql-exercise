<?php

namespace App\Questions;

use PDO;

class Q51 extends BaseQuestion
{
    public function execute(): void
    {
        $pdo = $this->getPdo();

        $sql = "
            WITH high_salary_employees AS (
                SELECT id, department_id, name, salary
                FROM employees
                WHERE salary > 300000
            )
            SELECT id, department_id, name, salary
            FROM high_salary_employees
            WHERE department_id = 1
            ORDER BY id
        ";

        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $this->displayTable($rows);
    }
}
