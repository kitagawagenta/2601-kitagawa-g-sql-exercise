<?php

namespace App\Questions;

class Q14 extends BaseQuestion
{
    public function execute(): void
    {
        // employeesテーブルから name と salary を取得する
        // CASE WHEN を使って salary を High / Mid / Low に分類する
        $this->queryAndDisplay(
            "SELECT
                name,
                salary,
                CASE
                    WHEN salary >= 400000 THEN 'High'
                    WHEN salary >= 330000 THEN 'Mid'
                    ELSE 'Low'
                END AS salary_rank
             FROM employees
             ORDER BY id;",
            "employees"
        );  
    }
}