<?php

namespace App\Questions;

use PDO;

class Q45 extends BaseQuestion
{
    public function execute(): void
    {
        $pdo = $this->getPdo();

        $sql = "
            SELECT e.id, e.department_id, e.name, e.salary
            FROM employees e
            WHERE e.salary > (
                SELECT AVG(salary)
                FROM employees
                WHERE department_id = e.department_id
            )
            ORDER BY e.id
        ";

        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $this->displayTable($rows);
    }
}
