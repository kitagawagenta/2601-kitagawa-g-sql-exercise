<?php

namespace App\Questions;

use PDOException;

class Q30 extends BaseQuestion
{
    public function execute(): void
    {
        $pdo = $this->getPdo();

        echo "employees INNER JOIN departments USING (department_id)\n";

        try {
            // USING は両テーブルで同じ列名が必要だが、departments 側には department_id がない。
            $stmt = $pdo->query(
                "SELECT
                    *
                 FROM employees
                 INNER JOIN departments
                 USING (department_id);"
            );
            $rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            $this->displayTable($rows);
        } catch (PDOException $e) {
            echo $e->getMessage() . "\n";
        }

        echo "\n";

        // NATURAL JOIN は同名列すべてを結合条件にするため、ここでは id で結合される。
        $this->queryAndDisplay(
            "SELECT
                *
             FROM employees
             NATURAL JOIN tasks;",
            "employees NATURAL JOIN tasks"
        );
    }
}
;