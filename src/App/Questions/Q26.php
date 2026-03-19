<?php

namespace App\Questions;

class Q26 extends BaseQuestion
{
    public function execute(): void
    {
        $this->queryAndDisplay(
            "SELECT
                id,
                department_id,
                name,
                salary
             FROM employees
             WHERE salary > 300000
             ORDER BY salary DESC
             LIMIT 1;",
            "employees"
        );

        echo "\n";

        $this->queryAndDisplay(
            "SELECT
                *
             FROM tasks
             ORDER BY created_at DESC
             LIMIT 2 OFFSET 1;",
            "tasks"
        );
    }
}
