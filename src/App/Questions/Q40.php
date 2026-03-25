<?php

namespace App\Questions;

use PDO;

class Q40 extends BaseQuestion
{
    public function execute(): void
    {
        $sql = "
            SELECT id, department_id, name, salary
            FROM employees
            WHERE salary > (
                SELECT AVG(salary)
                FROM employees
            )
            ORDER BY id
        ";

        $stmt = $this->getPdo()->prepare($sql);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $this->displayTable($rows);
    }
}
