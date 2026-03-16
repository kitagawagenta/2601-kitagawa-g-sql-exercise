<?php

namespace App\Questions;

class Q7 extends BaseQuestion
{
    public function execute(): void
    {
        $this->queryAndDisplay(
            "SELECT id, department_id, name, salary, ROUND(salary, -3) AS ROUND
             FROM employees;",
            "employees"
        );

        $this->queryAndDisplay(
            "SELECT POW(3, 4) AS POW;"
        );
    }
}
