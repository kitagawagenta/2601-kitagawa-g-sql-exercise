<?php

namespace App\Questions;

class Q32 extends BaseQuestion
{
    public function execute(): void
    {
        $this->queryAndDisplay(
            "SELECT
                employees.id AS employee_id,
                employees.department_id,
                employees.name AS employee_name,
                employees.salary,
                departments.id AS department_id_ref,
                departments.name AS department_name
             FROM employees
             LEFT JOIN departments
                ON employees.department_id = departments.id

             UNION

             SELECT
                employees.id AS employee_id,
                employees.department_id,
                employees.name AS employee_name,
                employees.salary,
                departments.id AS department_id_ref,
                departments.name AS department_name
             FROM employees
             RIGHT JOIN departments
                ON employees.department_id = departments.id;",
            "employees FULL OUTER JOIN departments"
        );
    }
}
