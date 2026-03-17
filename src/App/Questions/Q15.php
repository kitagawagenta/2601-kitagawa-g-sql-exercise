<?php

namespace App\Questions;

class Q15 extends BaseQuestion
{
    public function execute(): void
    {
        $this->queryAndDisplay(
            "SELECT
                id,
                employee_id,
                IFNULL(expires_at, '未設定') AS expires_at
             FROM tasks
             ORDER BY id;",
            "tasks"
        );

        echo "\n";

        $this->queryAndDisplay(
            "SELECT
                id,
                employee_id,
                COALESCE(expires_at, '未設定') AS expires_at
             FROM tasks
             ORDER BY id;",
            "tasks"
        );
    }
}
