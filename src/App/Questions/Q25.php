<?php

namespace App\Questions;

class Q25 extends BaseQuestion
{
    public function execute(): void
    {
        $this->queryAndDisplay(
            "SELECT
                *
             FROM employees
             ORDER BY salary DESC;",
            "employees"
        );

        echo "\n";

        $this->queryAndDisplay(
            "SELECT
                *
             FROM tasks
             ORDER BY employee_id DESC, id ASC;",
            "tasks"
        );
    }
}
