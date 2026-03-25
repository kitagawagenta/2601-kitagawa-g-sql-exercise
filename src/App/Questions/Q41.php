<?php

namespace App\Questions;

use PDO;

class Q41 extends BaseQuestion
{
    public function execute(): void
    {
        $pdo = $this->getPdo();

        $sql1 = "
            SELECT id, department_id, name, salary
            FROM (
                SELECT *
                FROM employees
            ) AS sub
            WHERE salary > 300000
            ORDER BY id
        ";

        $stmt1 = $pdo->prepare($sql1);
        $stmt1->execute();
        $rows1 = $stmt1->fetchAll(PDO::FETCH_ASSOC);
        $this->displayTable($rows1);
        echo "\n";

        $sql2 = "
            SELECT id, department_id, name, salary
            FROM employees
            WHERE department_id IN (
                SELECT id
                FROM departments
            )
            ORDER BY id
        ";

        $stmt2 = $pdo->prepare($sql2);
        $stmt2->execute();
        $rows2 = $stmt2->fetchAll(PDO::FETCH_ASSOC);
        $this->displayTable($rows2);
        echo "\n";

        $sql3 = "
            SELECT
                id,
                name,
                salary,
                (
                    SELECT AVG(salary)
                    FROM employees
                ) AS avg_salary
            FROM employees
            ORDER BY id
        ";

        $stmt3 = $pdo->prepare($sql3);
        $stmt3->execute();
        $rows3 = $stmt3->fetchAll(PDO::FETCH_ASSOC);
        $this->displayTable($rows3);
    }
}
