<?php

namespace App\Questions;

class Q24 extends BaseQuestion
{
    public function execute(): void
    {
        // employees テーブルにある department_id の種類数を取得する
        $this->queryAndDisplay(
            "SELECT
                COUNT(DISTINCT department_id) AS COUNT
             FROM employees;",
            "employees"
        );

        echo "\n";

        // tasks テーブルにある is_done の種類数を取得する
        $this->queryAndDisplay(
            "SELECT
                COUNT(DISTINCT is_done) AS COUNT
             FROM tasks;",
            "tasks"
        );
    }
}

/*
COUNT() は件数を数える
DISTINCT を付けると重複を除いて数える
department_id の種類数は 3
is_done の種類数は 2
*/
