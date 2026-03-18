<?php

namespace App\Questions;

class Q20 extends BaseQuestion
{
    public function execute(): void
    {
      // LOWER()は文字列を小文字に変換する関数
        $this->queryAndDisplay(
            "SELECT
                LOWER(name) AS LOWER
             FROM employees
             WHERE id = 1;",
            "employees"
        );

        echo "\n";

        // CONCAT()文字列をつなげる関数
        $this->queryAndDisplay(
            "SELECT
                CONCAT(name, ':', department_id) AS employee_info
             FROM employees
             ORDER BY id;",
            "employees"
        );

        echo "\n";

        // LPAD()は文字列の左側を指定した文字で埋める関数
        $this->queryAndDisplay(
            "SELECT
                LPAD(id, 4, '0') AS LPAD
             FROM employees
             ORDER BY id;",
            "employees"
        );
    }
}
