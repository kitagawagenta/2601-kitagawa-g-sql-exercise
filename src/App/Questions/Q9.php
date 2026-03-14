<?php

namespace App\Questions;

class Q9 extends BaseQuestion
{
    public function execute(): void
    {
        // salary の平均を出す
        $this->queryAndDisplay(
            "SELECT AVG(salary) AS AVG
             FROM employees;",
            "employees"
        );

        // salary の合計を出す
        $this->queryAndDisplay(
            "SELECT SUM(salary) AS SUM
             FROM employees;",
            "employees"
        );

        // salary の最大値・最小値・件数を1つのSQLでまとめて出す
        $this->queryAndDisplay(
            "SELECT MAX(salary) AS MAX, MIN(salary) AS MIN, COUNT(*) AS COUNT
             FROM employees;",
            "employees"
        );

        // department_id = 1 の従業員だけに絞って平均を出す
        $this->queryAndDisplay(
            "SELECT AVG(salary) AS AVG
             FROM employees
             WHERE department_id = 1;",
            "employees"
        );
    }
}
