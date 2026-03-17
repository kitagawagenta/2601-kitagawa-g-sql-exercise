<?php

namespace App\Questions;

class Q4 extends BaseQuestion
{
    public function execute(): void
    {
        $sql = "
            INSERT INTO departments (id, name)
            VALUES
                (3, 'HR'),
                (4, 'Finance')
        ";

        $this->getPdo()->exec($sql);
        $this->queryAndDisplay("SELECT * FROM departments;", "departments");
    }
}
