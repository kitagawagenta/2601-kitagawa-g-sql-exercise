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