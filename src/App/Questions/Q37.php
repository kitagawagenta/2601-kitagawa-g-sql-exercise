<?php

namespace App\Questions;

class Q37 extends BaseQuestion
{
    public function execute(): void
    {
        // タスクが割り当てられていない従業員だけを取得する
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
             LEFT JOIN tasks t
                ON e.id = t.employee_id
             WHERE t.id IS NULL;",
            "employees INNER JOIN departments LEFT JOIN tasks"
        );
    }
}
