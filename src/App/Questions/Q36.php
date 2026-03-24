<?php

namespace App\Questions;

class Q36 extends BaseQuestion
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
                departments.name AS department_name,
                tasks.id AS task_id,
                tasks.employee_id,
                tasks.is_done,
                tasks.expires_at,
                tasks.created_at
             FROM employees
             INNER JOIN departments
                ON employees.department_id = departments.id
             INNER JOIN tasks
                ON employees.id = tasks.employee_id
             WHERE departments.name = 'Sales';",
            "employees INNER JOIN departments INNER JOIN tasks"
        );
    }
}
