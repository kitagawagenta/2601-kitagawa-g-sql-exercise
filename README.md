# PHP + MySQL SQL研修

## はじめ方

```bash
# 1. 起動
docker compose up -d --build

# 2. PHPコンテナに入る
docker compose exec php bash

# 3. オートロード生成
composer install

# 4. テーブル作成・初期データ投入
php run.php --setup

# 5. Q1を実行
php run.php 1
```

SELECTでcreated_atでminとmaxの差を選んで
FROｍ tasksでどの表を使うか決めてtasksテーブルから取る。
WHEREがあれば絞って対象にする。

FROM：どの表をみるか
WHERE：どの行に絞るか
SELECT：なにを表示するか
