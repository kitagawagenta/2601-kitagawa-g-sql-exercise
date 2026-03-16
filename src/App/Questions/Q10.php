<?php

namespace App\Questions;

class Q10 extends BaseQuestion
{
    public function execute(): void
    {
        // department_id ごとの salary の平均を出す
        $this->queryAndDisplay(
            "SELECT department_id, AVG(salary) AS AVG
             FROM employees
             GROUP BY department_id;",
            "employees"
        );
    }
}
