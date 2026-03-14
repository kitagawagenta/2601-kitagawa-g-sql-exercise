<?php

namespace App\Questions;

class Q8 extends BaseQuestion
{
    public function execute(): void
    {
        $this->queryAndDisplay(
            "SELECT id, department_id, name, salary AS 月給
             FROM employees;",
            "employees"
        );

        $this->queryAndDisplay(
            "SELECT id, name, salary * 12 AS 年収
             FROM employees;"
        );
    }
}
