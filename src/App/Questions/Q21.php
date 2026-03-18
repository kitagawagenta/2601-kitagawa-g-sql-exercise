<?php

namespace App\Questions;

class Q21 extends BaseQuestion
{
    public function execute(): void
    {
        // name に l を含む従業員を取得する
        $this->queryAndDisplay(
            "SELECT
                *
             FROM employees
             WHERE name LIKE '%l%'
             ORDER BY id;",
            "employees"
        );

        echo "\n";

        // A で始まる名前を大文字小文字を区別して取得する
        $this->queryAndDisplay(
            "SELECT
                *
             FROM employees
             WHERE BINARY name LIKE 'A%'
             ORDER BY id;",
            "employees"
        );
    }
}

/*
LIKE は文字列の部分一致を調べる
'%l%' は l を含む
'A%' は A で始まる
BINARY を付けると大文字小文字を区別して比較できる
*/
