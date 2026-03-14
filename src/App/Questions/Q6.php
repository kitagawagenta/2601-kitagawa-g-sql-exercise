<?php

namespace App\Questions;

class Q6 extends BaseQuestion
{
    public function execute(): void
    {
        $this->queryAndDisplay(
            "SELECT id, department_id, name, salary
             FROM employees
             WHERE department_id = 1 AND salary > 300000;",
            "employees"
        );

        $this->queryAndDisplay(
            "SELECT id, department_id, name, salary
             FROM employees
             WHERE department_id = 1 OR department_id = 2;",
            "employees"
        );

        $this->queryAndDisplay(
            "SELECT id, department_id, name, salary
             FROM employees
             WHERE department_id != 3;",
            "employees"
        );

        $this->queryAndDisplay(
            "SELECT id, department_id, name, salary
             FROM employees
             WHERE (department_id = 1 OR department_id = 2)
             AND salary >= 300000;",
            "employees"
        );
    }
}