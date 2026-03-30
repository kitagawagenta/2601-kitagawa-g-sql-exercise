<?php

namespace App\Questions;

use PDO;

class Q54 extends BaseQuestion
{
    public function execute(): void
    {
        $pdo = $this->getPdo();

        $sql = "
            SELECT name
            FROM departments
            EXCEPT
            SELECT name
            FROM employees
        ";

        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $this->displayTable($rows);
    }
}
