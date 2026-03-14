<?php

namespace App\Questions;

class Q5 extends BaseQuestion
{
    public function execute(): void
    {
        $sql = "
            UPDATE employees
            SET salary = salary + 20000
            WHERE department_id = 1
        ";

        $this->getPdo()->exec($sql);
        $this->queryAndDisplay(
            "SELECT id, department_id, name, salary FROM employees ORDER BY id;",
            "employees"
        );
    }
}
