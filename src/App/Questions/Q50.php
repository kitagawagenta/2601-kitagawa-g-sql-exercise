<?php

namespace App\Questions;

use PDO;

class Q50 extends BaseQuestion
{
    public function execute(): void
    {
        $pdo = $this->getPdo();

        $sql = "
            SELECT e.id, e.department_id, e.name, e.salary
            FROM employees e
            WHERE EXISTS (
                SELECT *
                FROM tasks t
                WHERE t.employee_id = e.id
                  AND t.is_done = TRUE
            )
            ORDER BY e.id
        ";

        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $this->displayTable($rows);
    }
}
