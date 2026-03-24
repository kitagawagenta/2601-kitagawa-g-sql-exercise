<?php

namespace App\Questions;

class Q31 extends BaseQuestion
{
    public function execute(): void
    {
        $this->queryAndDisplay(
            "SELECT
                *
             FROM employees
                -- employees を左側の基準テーブルにする
             LEFT JOIN departments
                -- employees.department_id と departments.id を結び付ける
                ON employees.department_id = departments.id;",
            "employees LEFT JOIN departments"
        );

        echo "\n";

        $this->queryAndDisplay(
            "SELECT
                *
             FROM employees
                -- employees を左側の基準テーブルにする
             LEFT JOIN tasks
                -- employees.id と tasks.employee_id を結び付ける
                ON employees.id = tasks.employee_id;",
            "employees LEFT JOIN tasks"
        );
    }
}
