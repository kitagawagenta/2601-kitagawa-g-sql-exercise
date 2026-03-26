<?php

namespace App\Questions;

use PDO;

class Q44 extends BaseQuestion
{
    public function execute(): void
    {
        $pdo = $this->getPdo();

        $sql = "
            SELECT e.id, e.name, e.salary,
                   (
                       SELECT d.name
                       FROM departments d
                       WHERE d.id = e.department_id
                   ) AS dept_name
            FROM employees e
            ORDER BY e.id
        ";

        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $this->displayTable($rows);
    }
}
