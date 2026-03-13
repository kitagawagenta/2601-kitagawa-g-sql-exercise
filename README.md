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

- Q1: 

# これでSQLに入る
docker compose exec mysql mysql -u root -p

# ymlのDBを参考
USE training;　

# 挿入したSQL(事前準備)
USE training;

DROP TABLE IF EXISTS tasks;
DROP TABLE IF EXISTS employees;
DROP TABLE IF EXISTS departments;

CREATE TABLE departments (
    id   INT PRIMARY KEY NOT NULL,
    name VARCHAR(100) NOT NULL
);

CREATE TABLE employees (
    id            INT PRIMARY KEY NOT NULL,
    department_id INT NOT NULL,
    name          VARCHAR(100) NOT NULL,
    salary        INT NOT NULL
);

CREATE TABLE tasks (
    id          INT PRIMARY KEY NOT NULL,
    employee_id INT NOT NULL,
    is_done     BOOLEAN NOT NULL,
    expires_at  DATETIME,
    created_at  DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO departments VALUES
(1, 'Sales'),
(2, 'Engineering'),
(3, 'HR');

INSERT INTO employees VALUES
(1, 1, 'Alice', 350000),
(2, 1, 'Bob', 280000),
(3, 2, 'Carol', 420000),
(4, 3, 'Dave', 310000);

INSERT INTO tasks VALUES
(1, 1, TRUE,  '2024-01-15 18:00:00', '2024-01-10 09:00:00'),
(2, 2, FALSE, NULL,                  '2024-01-10 10:00:00'),
(3, 4, FALSE, '2024-01-14 18:00:00', '2024-01-11 09:00:00'),
(4, 4, TRUE,  NULL,                  '2024-01-12 09:00:00');

# もしSQL操作でコマンド操作をするなら
SELECT * FROM departments;
SELECT * FROM employees;
SELECT * FROM tasks;

# 出力結果
oroot@6359928682a9:/var/www/html# php run.php 1
=== Q1 ===
|id|name|
|---|---/
1, Sales
2, Engineering

|id|name|department_id|salary|
|---|---|---|---/
1, Alice, 1, 350000
2, Bob, 1, 280000
3, Carol, 2, 420000
4, Dave, 2, 310000
5, Eve, 3, 290000

|id|employee_id|is_done|expires_at|created_at|
|---|---|---|---|---/
1, 1, 0, 2024-01-15 18:00:00, 2024-01-13 09:00:00
2, 1, 1, , 2024-01-13 10:00:00
3, 2, 0, 2024-01-20 18:00:00, 2024-01-14 09:00:00
4, 3, 1, 2024-01-18 18:00:00, 2024-01-14 11:00:00


- Q2: 

# 実行するSQL(今回はPHPでSQLクエリを実行するので不要)

<!-- departmentsテーブルからidが３の行を削除する -->
DELETE FROM departments
WHERE id = 3;

<!-- id = 3の行が削除されたという意味 -->
Query OK, 1 row affected (0.01 sec)


<!-- 結果 -->
mysql> select * from departments
    -> ;
+----+-------------+
| id | name        |
+----+-------------+
|  1 | Sales       |
|  2 | Engineering |
+----+-------------+
2 rows in set (0.01 sec)

# 実行コマンド
 php run.php 2

# 出力結果

 === Q2 ===
--- Q2: departments ---
|id|name|
|---|---|
|1|Sales|
|2|Engineering|