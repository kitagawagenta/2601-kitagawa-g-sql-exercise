<?php

namespace App\Questions;

class Q22 extends BaseQuestion
{
    public function execute(): void
    {
        // name が e または b で終わる従業員を取得する
        $this->queryAndDisplay(
            "SELECT
                *
             FROM employees
             WHERE name REGEXP '[eb]$'
             ORDER BY id;",
            "employees"
        );

        echo "\n";

        // name が C で始まらない従業員を取得する
        $this->queryAndDisplay(
            "SELECT
                *
             FROM employees
             WHERE name NOT REGEXP '^C'
             ORDER BY id;",
            "employees"
        );
    }
}

/*
REGEXP は正規表現で文字列を検索する
'[eb]$' は e または b で終わる
'^C' は C で始まる
NOT REGEXP を使うと条件に一致しないものを取得できる
*/
