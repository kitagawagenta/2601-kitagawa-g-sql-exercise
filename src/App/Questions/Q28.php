<?php

namespace App\Questions;

class Q28 extends BaseQuestion
{
    public function execute(): void
    {
        $this->queryAndDisplay(
            "SELECT
                employee_id,
                COUNT(*) - COUNT(expires_at) AS no_expires_count
             FROM tasks
             GROUP BY employee_id
             ORDER BY no_expires_count DESC;",
            "tasks"
        );

        echo "\n";

        $this->queryAndDisplay(
            "SELECT
                department_id,
                ROUND(AVG(salary)) AS avg_salary
             FROM employees
             WHERE salary > 300000 OR department_id = 2
             GROUP BY department_id
             HAVING ROUND(AVG(salary)) >= 300000
             ORDER BY avg_salary DESC
             LIMIT 2;",
            "employees"
        );
    }
}
