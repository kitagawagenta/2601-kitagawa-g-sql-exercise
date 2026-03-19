<?php

namespace App\Questions;

class Q27 extends BaseQuestion
{
    public function execute(): void
    {
        // BETWEEN 2 AND 4 は「2 と 4 の間」という形で、2以上4以下を表す
        $this->queryAndDisplay(
            "SELECT
                *
             FROM tasks
             WHERE id BETWEEN 2 AND 4
             ORDER BY id;",
            "tasks"
        );

        echo "\n";

        // IN (1, 2) は「1 と 2 の中にある」という形で、1 または 2 を表す
        $this->queryAndDisplay(
            "SELECT
                id,
                department_id,
                name,
                salary
             FROM employees
             WHERE department_id IN (1, 2)
             ORDER BY id;",
            "employees"
        );
    }
}