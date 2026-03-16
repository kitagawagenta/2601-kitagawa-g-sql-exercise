<?php

namespace App\Questions;

class Q11 extends BaseQuestion
{
    public function execute(): void
    {
        // department_id = 3 を除外して、部署ごとの平均 salary を出す
        $this->queryAndDisplay(
            "SELECT department_id, AVG(salary) AS AVG
             FROM employees
             WHERE department_id != 3
             GROUP BY department_id;",
            "employees"
        );

        // 部署ごとの平均 salary を出し、平均が 310000 より大きい部署だけ表示する
        $this->queryAndDisplay(
            "SELECT department_id, AVG(salary) AS AVG
             FROM employees
             GROUP BY department_id
             HAVING AVG(salary) > 310000;",
            "employees"
        );

        // department_id = 3 を除外し、さらに平均が 310000 より大きい部署だけ表示する
        $this->queryAndDisplay(
            "SELECT department_id, AVG(salary) AS AVG
             FROM employees
             WHERE department_id != 3
             GROUP BY department_id
             HAVING AVG(salary) > 310000;",
            "employees"
        );
    }
}
