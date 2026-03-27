<?php

namespace App\Questions;

use PDO;

class Q52 extends BaseQuestion
{
    public function execute(): void
    {
        $pdo = $this->getPdo();

        $sql1 = "
            SELECT name
            FROM departments
            UNION
            SELECT name
            FROM employees
        ";

        $stmt1 = $pdo->prepare($sql1);
        $stmt1->execute();
        $rows1 = $stmt1->fetchAll(PDO::FETCH_ASSOC);
        $this->displayTable($rows1);
        echo "\n";

        $sql2 = "
            SELECT name
            FROM departments
            UNION ALL
            SELECT name
            FROM employees
        ";

        $stmt2 = $pdo->prepare($sql2);
        $stmt2->execute();
        $rows2 = $stmt2->fetchAll(PDO::FETCH_ASSOC);
        $this->displayTable($rows2);
    }
}
