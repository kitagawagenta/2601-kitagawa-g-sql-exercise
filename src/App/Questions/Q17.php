<?php

namespace App\Questions;

class Q17 extends BaseQuestion
{
    public function execute(): void
    {
        $this->queryAndDisplay(
            "SELECT
                TIMESTAMPDIFF(SECOND, MIN(created_at), NOW()) AS TIMESTAMPDIFF
             FROM tasks;",
            "tasks"
        );

        echo "\n";

        $this->queryAndDisplay(
            "SELECT
                YEAR(created_at) AS YEAR
             FROM tasks
             ORDER BY id;",
            "tasks"
        );
    }
}
/*
TIMESTAMPDIFF(SECOND,MIN(created_at),NOW())
日時の差を秒で求める

MIN(created_at)
created_atの最小値、つまり一番古い日時を取り出す。

NOW()現在日時を返す。

YEAR(created_at)日時から年だけを取り出す。

SELECT：何を取り出すかを書く
FROM tasks：tasksテーブルから取る
AS TIMESTAMPDIFF,AS YEAR:表示する列名を付ける。
ORDER BY id:id順に並べる
*/
