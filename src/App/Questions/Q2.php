<?php

namespace App\Questions;

use PDO;

class Q2 extends BaseQuestion
{
public function execute(): void
{
    // 実行のみ
    $this->getPdo()->exec("DELETE FROM departments WHERE id = 3;");

    // 取得と表示
    $this->queryAndDisplay("SELECT * FROM departments;", "departments");
}
    }