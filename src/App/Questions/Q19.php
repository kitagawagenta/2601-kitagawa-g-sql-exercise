<?php

namespace App\Questions;

class Q19 extends BaseQuestion
{
  public function execute():void
  {
    $this->queryAndDisplay(
      "SELECT
      DATE_FORMAT(created_at, '%Y%m%d') AS DATE_FORMAT
      FROM tasks
      ORDER BY id;",
      "tasks"
    );
  }
}

/*
DATE_FORMAT()は、日付や日時を好きな表示形式の文字列に変換する関数

created_atはDATETIME型ですが、'%Y%m%d'を指定できる。
*/
