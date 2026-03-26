<?php

namespace App\Questions;

use PDO;

class Q42 extends BaseQuestion
{
    public function execute(): void
    {
        $pdo = $this->getPdo();

        $sql = "
            SELECT
                e.id,
                e.department_id,
                e.name,
                e.salary,
                d.id AS department_id_from_departments,
                d.name AS department_name
            FROM (
                SELECT *
                FROM employees
                WHERE salary > 300000
            ) AS e
            INNER JOIN (
                SELECT *
                FROM departments
            ) AS d
                ON e.department_id = d.id
            ORDER BY e.id
        ";

        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $this->displayTable($rows);
    }
}
