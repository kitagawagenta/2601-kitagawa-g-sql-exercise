<?php

namespace App\Questions;

class Q35 extends BaseQuestion
{
    public function execute(): void
    {
        $this->queryAndDisplay(
            "SELECT
                e.id AS e_id,
                e.department_id AS dept_id,
                e.name AS e_name,
                e.salary,
                d.id AS d_id,
                d.name AS d_name,
                t.id AS t_id,
                t.employee_id AS emp_id,
                t.is_done,
                t.expires_at,
                t.created_at
             FROM employees e
             INNER JOIN departments d
                ON e.department_id = d.id
             INNER JOIN tasks t
                ON e.id = t.employee_id;",
            "employees INNER JOIN departments INNER JOIN tasks"
        );
    }
}
