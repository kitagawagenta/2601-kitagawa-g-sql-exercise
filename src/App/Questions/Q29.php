<?php

namespace App\Questions;

class Q29 extends BaseQuestion
{
    public function execute(): void
    {
        $this->queryAndDisplay(
            "SELECT
                *
             FROM employees
             INNER JOIN departments
                ON employees.department_id = departments.id;",
            "employees × departments"
        );

        echo "\n";

        $this->queryAndDisplay(
            "SELECT
                *
             FROM employees
             INNER JOIN tasks
                ON employees.id = tasks.employee_id;",
            "employees × tasks"
        );
    }
}
