<?php

namespace App\Questions;

class Q2 extends BaseQuestion
{
    public function execute(): void
    {
        $this->getPdo()->exec("DELETE FROM departments WHERE id = 3;");
        $this->queryAndDisplay("SELECT * FROM departments;", "departments");
    }
}
