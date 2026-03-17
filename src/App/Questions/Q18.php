<?php

namespace App\Questions;

class Q18 extends BaseQuestion
{
    public function execute(): void
    {
        $this->queryAndDisplay(
            "SELECT
                NOW() AS now_1,
                SLEEP(2) AS sleep_result,
                NOW() AS now_2;",
            "NOW() は文の開始時刻で固定"
        );

        echo "\n";

        $this->queryAndDisplay(
            "SELECT
                SYSDATE() AS sysdate_1,
                SLEEP(2) AS sleep_result,
                SYSDATE() AS sysdate_2;",
            "SYSDATE() は呼び出した時点の時刻"
        );
    }
}

/*
NOW()SQL文の開始時刻を返す
SYSDATE()呼び出した瞬間の時刻を返す
SLEEP(2)2秒待つ*/
