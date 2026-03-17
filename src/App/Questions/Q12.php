<?php

namespace App\Questions;

class Q12 extends BaseQuestion
{
    public function execute(): void
    {
        // tasks テーブルの全レコード数を取得する
        // COUNT(*) は NULL を含めた全行を数える
        $this->queryAndDisplay(
            "SELECT COUNT(*) AS COUNT
             FROM tasks;",
            "tasks"
        );

        // expires_at が入っている行数を取得する
        // COUNT(expires_at) は expires_at が NULL の行を数えない
        $this->queryAndDisplay(
            "SELECT COUNT(expires_at) AS COUNT
             FROM tasks;",
            "tasks"
        );
    }
}
