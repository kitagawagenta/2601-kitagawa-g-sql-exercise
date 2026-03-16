<?php

namespace App\Questions;

class Q13 extends BaseQuestion
{
    public function execute(): void
    {
        $this->queryAndDisplay(
            "SELECT *
             FROM tasks
             WHERE expires_at IS NULL
             ORDER BY id;",
            "tasks"
        );

        $this->queryAndDisplay(
            "SELECT *
             FROM tasks
             WHERE expires_at IS NOT NULL
             ORDER BY id;",
            "tasks"
        );
    }
}
