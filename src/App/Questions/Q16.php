<?php

namespace App\Questions;

class Q16 extends BaseQuestion
{
    public function execute(): void
    {
        $this->queryAndDisplay(
            "SELECT
                TIMESTAMPDIFF(SECOND, MIN(created_at), MAX(created_at)) AS TIMESTAMPDIFF
             FROM tasks;",
            "tasks"
        );
        


        $this->queryAndDisplay(
            "SELECT
                DATE_SUB(created_at, INTERVAL 15 HOUR) AS DATE_SUB
             FROM tasks
             WHERE id = 1;",
            "tasks"
        );
    }
}

// MYSQLの組み込み関数
// TIMESTAMPDIFF()→２つの時間差を求める
// MIN()
// MAX()
// DATE_SUB()→日時から指定した時間や日数を引く
// INTERVAL→時間指定のまとまりを指定

// 自作メソッド
// execute(),queryAndDIsplay()