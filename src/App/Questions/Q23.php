<?php

namespace App\Questions;

class Q23 extends BaseQuestion
{
    public function execute(): void
    {
        // employees テーブルから department_id の重複を除いて取得する
        $this->queryAndDisplay(
            "SELECT
            DISTINCT department_id
             FROM employees
             ORDER BY department_id;",
            "employees"
        );

        echo "\n";

        // tasks テーブルから is_done の重複を除いて取得する
        $this->queryAndDisplay(
            "SELECT
                DISTINCT is_done
             FROM tasks
             ORDER BY is_done;",
            "tasks"
        );
    }
}
