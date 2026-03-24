<?php

namespace App\Questions;

class Q34 extends BaseQuestion
{
    public function execute(): void
    {
        $this->queryAndDisplay(
            "SELECT
                a.id AS a_id,
                a.name AS a_name,
                b.id AS b_id,
                b.name AS b_name,
                a.department_id
             FROM employees a
             INNER JOIN employees b
                ON a.department_id = b.department_id
             WHERE a.id < b.id;",
            "employees self join"
        );
    }
}
