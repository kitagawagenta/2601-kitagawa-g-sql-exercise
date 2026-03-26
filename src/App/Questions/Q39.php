<?php

namespace App\Questions;

class Q39 extends BaseQuestion
{
    public function execute(): void
    {
        $sql = "
            UPDATE departments d
            INNER JOIN employees e
                ON d.id = e.department_id
            SET d.name = e.name
            WHERE d.name = ''
        ";

        $this->getPdo()->exec($sql);
        $this->queryAndDisplay(
            "SELECT id, name FROM departments ORDER BY id;",
            "departments"
        );
    }
}

