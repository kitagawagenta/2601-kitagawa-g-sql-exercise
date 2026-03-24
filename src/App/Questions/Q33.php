<?php

namespace App\Questions;

class Q33 extends BaseQuestion
{
    public function execute(): void
    {
        $this->queryAndDisplay(
            "SELECT
                *
             FROM employees
             LEFT JOIN departments
                ON employees.department_id = departments.id
             WHERE departments.id IS NULL;",
            "employees LEFT JOIN departments"
        );
    }
}
