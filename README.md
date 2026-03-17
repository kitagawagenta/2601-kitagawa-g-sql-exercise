# 実装においての注意点


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

# MySQL ハンズオン SQL 問題集

---

## 4章 DML(基礎)

> **テーブル構成:**  
> `departments`（部署）、`employees`（従業員）、`tasks`（タスク）

---

### ■ 事前準備

```sql
CREATE DATABASE practice04;
USE practice04;

CREATE TABLE departments (
    id   INT         PRIMARY KEY NOT NULL,
    name VARCHAR(100) NOT NULL
);

CREATE TABLE employees (
    id            INT          PRIMARY KEY NOT NULL,
    department_id INT          NOT NULL,
    name          VARCHAR(100) NOT NULL,
    salary        INT          NOT NULL
);

CREATE TABLE tasks (
    id          INT      PRIMARY KEY NOT NULL,
    employee_id INT      NOT NULL,
    is_done     BOOLEAN  NOT NULL,
    expires_at  DATETIME,
    created_at  DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO departments VALUES (1,'Sales'),(2,'Engineering'),(3,'HR');

INSERT INTO employees VALUES
    (1, 1, 'Alice', 350000),
    (2, 1, 'Bob',   280000),
    (3, 2, 'Carol', 420000),
    (4, 3, 'Dave',  310000);

INSERT INTO tasks (id, employee_id, is_done, expires_at, created_at) VALUES
    (1, 1, TRUE,  '2024-01-15 18:00:00', '2024-01-10 09:00:00'),
    (2, 2, FALSE, NULL,                  '2024-01-10 10:00:00'),
    (3, 4, FALSE, '2024-01-14 18:00:00', '2024-01-11 09:00:00'),
    (4, 4, TRUE,  NULL,                  '2024-01-12 09:00:00');
```

**departments**

| id | name |
|----|------|
| 1 | Sales |
| 2 | Engineering |
| 3 | HR |

**employees**

| id | department_id | name | salary |
|----|--------------|------|--------|
| 1 | 1 | Alice | 350000 |
| 2 | 1 | Bob | 280000 |
| 3 | 2 | Carol | 420000 |
| 4 | 3 | Dave | 310000 |

**tasks**

| id | employee_id | is_done | expires_at | created_at |
|----|------------|---------|------------|------------|
| 1 | 1 | 1 | 2024-01-15 18:00:00 | 2024-01-10 09:00:00 |
| 2 | 2 | 0 | NULL | 2024-01-10 10:00:00 |
| 3 | 4 | 0 | 2024-01-14 18:00:00 | 2024-01-11 09:00:00 |
| 4 | 4 | 1 | NULL | 2024-01-12 09:00:00 |

---

### ● Q1 シンプルなSELECT

各テーブルの全データを表示するSQLをそれぞれ実行せよ。

**期待出力（departments）**

| id | name |
|----|------|
| 1 | Sales |
| 2 | Engineering |
| 3 | HR |

**期待出力（employees）**

| id | department_id | name | salary |
|----|--------------|------|--------|
| 1 | 1 | Alice | 350000 |
| 2 | 1 | Bob | 280000 |
| 3 | 2 | Carol | 420000 |
| 4 | 3 | Dave | 310000 |

**期待出力（tasks）**

| id | employee_id | is_done | expires_at | created_at |
|----|------------|---------|------------|------------|
| 1 | 1 | 1 | 2024-01-15 18:00:00 | 2024-01-10 09:00:00 |
| 2 | 2 | 0 | NULL | 2024-01-10 10:00:00 |
| 3 | 4 | 0 | 2024-01-14 18:00:00 | 2024-01-11 09:00:00 |
| 4 | 4 | 1 | NULL | 2024-01-12 09:00:00 |

---

### ● Q2 レコードの削除

`departments`テーブルから `id = 3` のレコードを削除せよ。削除後、`SELECT`で結果を確認すること。

**期待出力**

| id | name |
|----|------|
| 1 | Sales |
| 2 | Engineering |

---

### ● Q3 1件のINSERT

`tasks`テーブルに以下のレコードをINSERTせよ。

| id | employee_id | is_done | expires_at | created_at |
|----|------------|---------|------------|------------|
| 5 | 1 | TRUE | 2024-01-16 18:00:00 | 2024-01-13 09:00:00 |

**期待出力（INSERT後のtasks全件）**

| id | employee_id | is_done | expires_at | created_at |
|----|------------|---------|------------|------------|
| 1 | 1 | 1 | 2024-01-15 18:00:00 | 2024-01-10 09:00:00 |
| 2 | 2 | 0 | NULL | 2024-01-10 10:00:00 |
| 3 | 4 | 0 | 2024-01-14 18:00:00 | 2024-01-11 09:00:00 |
| 4 | 4 | 1 | NULL | 2024-01-12 09:00:00 |
| 5 | 1 | 1 | 2024-01-16 18:00:00 | 2024-01-13 09:00:00 |

---

### ● Q4 複数行のINSERT

`departments`テーブルに以下の2件を1つのINSERT文でまとめて追加せよ。

| id | name |
|----|------|
| 3 | HR |
| 4 | Finance |

**期待出力**

| id | name |
|----|------|
| 1 | Sales |
| 2 | Engineering |
| 3 | HR |
| 4 | Finance |

---

### ● Q5 レコードの更新

`employees`テーブルで `department_id = 1` に所属する従業員全員の `salary` を一律20,000円増額するUPDATEを実行せよ。更新後、`SELECT`で確認すること。

**期待出力**

| id | department_id | name | salary |
|----|--------------|------|--------|
| 1 | 1 | Alice | 370000 |
| 2 | 1 | Bob | 300000 |
| 3 | 2 | Carol | 420000 |
| 4 | 3 | Dave | 310000 |

---

### ■ ここまでのデータ状態

以降の問題はQ2〜Q5のDML実行後の状態を前提とする。

**departments**

| id | name |
|----|------|
| 1 | Sales |
| 2 | Engineering |
| 3 | HR |
| 4 | Finance |

**employees**

| id | department_id | name | salary |
|----|--------------|------|--------|
| 1 | 1 | Alice | 370000 |
| 2 | 1 | Bob | 300000 |
| 3 | 2 | Carol | 420000 |
| 4 | 3 | Dave | 310000 |

**tasks**

| id | employee_id | is_done | expires_at | created_at |
|----|------------|---------|------------|------------|
| 1 | 1 | 1 | 2024-01-15 18:00:00 | 2024-01-10 09:00:00 |
| 2 | 2 | 0 | NULL | 2024-01-10 10:00:00 |
| 3 | 4 | 0 | 2024-01-14 18:00:00 | 2024-01-11 09:00:00 |
| 4 | 4 | 1 | NULL | 2024-01-12 09:00:00 |
| 5 | 1 | 1 | 2024-01-16 18:00:00 | 2024-01-13 09:00:00 |

---

### ● Q6 複数条件の指定

① `department_id = 1` かつ `salary > 300000` の従業員を取得せよ。

**期待出力**

| id | department_id | name | salary |
|----|--------------|------|--------|
| 1 | 1 | Alice | 370000 |

② `department_id = 1` または `department_id = 2` の従業員を取得せよ。

**期待出力**

| id | department_id | name | salary |
|----|--------------|------|--------|
| 1 | 1 | Alice | 370000 |
| 2 | 1 | Bob | 300000 |
| 3 | 2 | Carol | 420000 |

③ `department_id` が3でない従業員を取得せよ。

**期待出力**

| id | department_id | name | salary |
|----|--------------|------|--------|
| 1 | 1 | Alice | 370000 |
| 2 | 1 | Bob | 300000 |
| 3 | 2 | Carol | 420000 |

④ `(department_id = 1 または department_id = 2)` かつ `salary >= 300000` の従業員を取得せよ。

**期待出力**

| id | department_id | name | salary |
|----|--------------|------|--------|
| 1 | 1 | Alice | 370000 |
| 2 | 1 | Bob | 300000 |
| 3 | 2 | Carol | 420000 |

---

### ● Q7 算術関数

① `salary`を千円単位に四捨五入した値を全列と一緒に表示せよ。

> **ヒント:** `ROUND(salary, -3)` で千の位で四捨五入できる。

**期待出力**

| id | department_id | name | salary | ROUND |
|----|--------------|------|--------|-----------------|
| 1 | 1 | Alice | 370000 | 370000 |
| 2 | 1 | Bob | 300000 | 300000 |
| 3 | 2 | Carol | 420000 | 420000 |
| 4 | 3 | Dave | 310000 | 310000 |

② `3` の `4` 乗を求めよ。

> **補足:** MySQLで `^` はビットXOR演算子。べき乗には `POW()` または `POWER()` を使う。

**期待出力**

| POW |
|---------|
| 81.0 |

---

### ● Q8 カラムの別名

① `salary`列に `月給` という別名をつけて表示せよ。

**期待出力**

| id | department_id | name | 月給 |
|----|--------------|------|------|
| 1 | 1 | Alice | 370000 |
| 2 | 1 | Bob | 300000 |
| 3 | 2 | Carol | 420000 |
| 4 | 3 | Dave | 310000 |

② `salary * 12` を計算し、`年収` という別名で表示せよ。

**期待出力**

| id | name | 年収 |
|----|------|------|
| 1 | Alice | 4440000 |
| 2 | Bob | 3600000 |
| 3 | Carol | 5040000 |
| 4 | Dave | 3720000 |

---

### ● Q9 集約関数

`employees`テーブルの`salary`について以下を求めよ。

① 平均（`AVG`）

**期待出力**

| AVG |
|------------|
| 350000.0000 |

② 合計（`SUM`）

**期待出力**

| SUM |
|------------|
| 1400000 |

③ 最大（`MAX`）・最小（`MIN`）・件数（`COUNT`）を1クエリで表示せよ。

**期待出力**

| MAX | MIN | COUNT |
|------------|------------|---------|
| 420000 | 300000 | 4 |

④ `department_id = 1` の従業員の平均`salary`を求めよ。

**期待出力**

| AVG |
|------------|
| 335000.0000 |

---

### ● Q10 集約関数とGROUP BY

`department_id`ごとの平均`salary`を求めよ。

**期待出力**

| department_id | AVG |
|--------------|------------|
| 1 | 335000.0000 |
| 2 | 420000.0000 |
| 3 | 310000.0000 |

---

### ● Q11 WHERE・GROUP BY・HAVINGの組み合わせ

① `department_id = 3` を除外した上で、`department_id`ごとの平均`salary`を求めよ。

**期待出力**

| department_id | AVG |
|--------------|------------|
| 1 | 335000.0000 |
| 2 | 420000.0000 |

② `department_id`ごとの平均`salary`を求め、平均が310,000より大きいグループのみ表示せよ。

**期待出力**

| department_id | AVG |
|--------------|------------|
| 1 | 335000.0000 |
| 2 | 420000.0000 |

③ ①と②の条件を組み合わせて実行せよ。

**期待出力**

| department_id | AVG |
|--------------|------------|
| 1 | 335000.0000 |
| 2 | 420000.0000 |

---

### ● Q12 COUNT(*) と COUNT(列名) の違い

① `tasks`テーブルの全レコード数を取得せよ。

**期待出力**

| COUNT |
|---------|
| 5 |

② `expires_at`が設定されている（NULLでない）タスクの件数を取得せよ。

**期待出力**

| COUNT |
|------------------|
| 3 |

> **補足:** `COUNT(*)`はNULLを含む全行を数えるが、`COUNT(列名)`はNULLを除いた行数を返す。

---

### ● Q13 NULLの扱い

① `tasks`テーブルから`expires_at`がNULLのレコードを取得せよ。

**期待出力**

| id | employee_id | is_done | expires_at | created_at |
|----|------------|---------|------------|------------|
| 2 | 2 | 0 | NULL | 2024-01-10 10:00:00 |
| 4 | 4 | 1 | NULL | 2024-01-12 09:00:00 |

② `expires_at`がNULLでないレコードを取得せよ。

**期待出力**

| id | employee_id | is_done | expires_at | created_at |
|----|------------|---------|------------|------------|
| 1 | 1 | 1 | 2024-01-15 18:00:00 | 2024-01-10 09:00:00 |
| 3 | 4 | 0 | 2024-01-14 18:00:00 | 2024-01-11 09:00:00 |
| 5 | 1 | 1 | 2024-01-16 18:00:00 | 2024-01-13 09:00:00 |

---

### ● Q14 CASE WHEN

`employees`テーブルの`salary`を以下の基準で分類し、`salary_rank`という列名で表示せよ。

- `salary >= 400000` → `'High'`
- `salary >= 330000` → `'Mid'`
- それ以外 → `'Low'`

**期待出力**

| name | salary | salary_rank |
|------|--------|------------|
| Alice | 370000 | Mid |
| Bob | 300000 | Low |
| Carol | 420000 | High |
| Dave | 310000 | Low |

---

### ● Q15 IFNULL / COALESCE

① `tasks`テーブルの`expires_at`がNULLの場合は`'未設定'`という文字列に置き換えて表示せよ（`IFNULL`を使用）。

**期待出力**

| id | employee_id | expires_at |
|----|------------|------------|
| 1 | 1 | 2024-01-15 18:00:00 |
| 2 | 2 | 未設定 |
| 3 | 4 | 2024-01-14 18:00:00 |
| 4 | 4 | 未設定 |
| 5 | 1 | 2024-01-16 18:00:00 |

② ①を`COALESCE`を使って書き直せ。

> **補足:** `COALESCE(a, b)` は`a`がNULLでなければ`a`を、NULLなら`b`を返す。複数引数に対応している点が`IFNULL`との違い。

---

### ● Q16 日付・時刻の演算

① `tasks`テーブルの`created_at`の最大値と最小値の差を秒で求めよ。

> **ヒント:** `TIMESTAMPDIFF(SECOND, 小さい方, 大きい方)`

**期待出力**

| TIMESTAMPDIFF |
|--------------------------------------------------------|
| 259200 |

② `id = 1` のタスクの`created_at`から15時間前の日時を求めよ。

> **ヒント:** `DATE_SUB(日時, INTERVAL 15 HOUR)`

**期待出力**

| DATE_SUB |
|---------------------------------------|
| 2024-01-09 18:00:00 |

---

### ● Q17 日付・時刻の抽出

① `tasks`テーブルの`created_at`の最小値から現在日時までの差を秒で求めよ。

**期待出力（実行時刻により変化する）**

```
（実行時刻による）
```

② `created_at`から年だけを抽出せよ。

**期待出力**

| YEAR |
|-----------------|
| 2024 |
| 2024 |
| 2024 |
| 2024 |
| 2024 |

---

### ● Q18 NOW() と SYSDATE() の違い

以下を実行し、`NOW()`と`SYSDATE()`の挙動の違いを確認せよ。

```sql
SELECT NOW(), SLEEP(2), NOW();
SELECT SYSDATE(), SLEEP(2), SYSDATE();
```

**期待出力イメージ**

```
-- NOW(): 3列とも同じ時刻（ステートメント開始時刻で固定）
| 2024-01-10 09:00:00 | 0 | 2024-01-10 09:00:00 |

-- SYSDATE(): 3列目は2秒後の時刻（呼び出し時点の実際の時刻）
| 2024-01-10 09:00:00 | 0 | 2024-01-10 09:00:02 |
```

> **補足:** `NOW()`はPostgreSQLの`statement_timestamp()`、`SYSDATE()`は`clock_timestamp()`に相当する。

---

### ● Q19 日付の書式変換

`tasks`テーブルの`created_at`を`'YYYYMMDD'`形式の文字列に変換して表示せよ。

**期待出力**

| DATE_FORMAT |
|---------------------------------|
| 20240110 |
| 20240110 |
| 20240111 |
| 20240112 |
| 20240113 |

---

### ● Q20 文字列関数

① `id = 1` の従業員の`name`を小文字に変換して表示せよ。

**期待出力**

| LOWER |
|------------|
| alice |

② `name`と`department_id`をコロン(`:`)でつないで `employee_info` という別名で表示せよ。

**期待出力**

| employee_info |
|--------------|
| Alice:1 |
| Bob:1 |
| Carol:2 |
| Dave:3 |

③ `id`を4桁の0パディング文字列で表示せよ（例: `1` → `0001`）。

**期待出力**

| LPAD |
|---------------|
| 0001 |
| 0002 |
| 0003 |
| 0004 |

---

### ● Q21 文字検索（LIKE）

① `name`に `'l'` を含む従業員を取得せよ（大文字・小文字を区別しない）。

**期待出力**

| id | department_id | name | salary |
|----|--------------|------|--------|
| 1 | 1 | Alice | 370000 |
| 3 | 2 | Carol | 420000 |

② `name`が `'A'` で始まる従業員を大文字・小文字を区別して取得せよ。

**期待出力**

| id | department_id | name | salary |
|----|--------------|------|--------|
| 1 | 1 | Alice | 370000 |

---

### ● Q22 正規表現検索（REGEXP）

① `name`が `'e'` または `'b'` で終わる従業員を取得せよ（大文字・小文字を区別しない）。

**期待出力**

| id | department_id | name | salary |
|----|--------------|------|--------|
| 1 | 1 | Alice | 370000 |
| 2 | 1 | Bob | 300000 |
| 4 | 3 | Dave | 310000 |

② `name`が `'C'` で始まらない従業員を取得せよ。

**期待出力**

| id | department_id | name | salary |
|----|--------------|------|--------|
| 1 | 1 | Alice | 370000 |
| 2 | 1 | Bob | 300000 |
| 4 | 3 | Dave | 310000 |

---

### ● Q23 重複排除

① `employees`テーブルから`department_id`の重複を排除して表示せよ。

**期待出力**

| department_id |
|--------------|
| 1 |
| 2 |
| 3 |

② `tasks`テーブルから`is_done`の種類を重複排除して表示せよ。

**期待出力**

| is_done |
|---------|
| 0 |
| 1 |

---

### ● Q24 COUNT(DISTINCT)

① `employees`テーブルに存在する`department_id`の種類数を取得せよ。

**期待出力**

| COUNT |
|------------------------------|
| 3 |

② `tasks`テーブルで`is_done`の値の種類数を取得せよ。

**期待出力**

| COUNT |
|------------------------|
| 2 |

---

### ● Q25 並び替え（ORDER BY）

① `employees`テーブルを`salary`の降順で表示せよ。

**期待出力**

| id | department_id | name | salary |
|----|--------------|------|--------|
| 3 | 2 | Carol | 420000 |
| 1 | 1 | Alice | 370000 |
| 4 | 3 | Dave | 310000 |
| 2 | 1 | Bob | 300000 |

② `tasks`テーブルを`employee_id`の降順、同じ場合は`id`の昇順で表示せよ。

**期待出力**

| id | employee_id | is_done | expires_at | created_at |
|----|------------|---------|------------|------------|
| 3 | 4 | 0 | 2024-01-14 18:00:00 | 2024-01-11 09:00:00 |
| 4 | 4 | 1 | NULL | 2024-01-12 09:00:00 |
| 2 | 2 | 0 | NULL | 2024-01-10 10:00:00 |
| 1 | 1 | 1 | 2024-01-15 18:00:00 | 2024-01-10 09:00:00 |
| 5 | 1 | 1 | 2024-01-16 18:00:00 | 2024-01-13 09:00:00 |

---

### ● Q26 取得件数の制限（LIMIT / OFFSET）

① `salary`が300,000より大きい従業員を`salary`の降順で並べ、1件だけ取得せよ。

**期待出力**

| id | department_id | name | salary |
|----|--------------|------|--------|
| 3 | 2 | Carol | 420000 |

② `tasks`を`created_at`の降順で並べ、2件目から2件分を取得せよ。

**期待出力**

| id | employee_id | is_done | expires_at | created_at |
|----|------------|---------|------------|------------|
| 4 | 4 | 1 | NULL | 2024-01-12 09:00:00 |
| 3 | 4 | 0 | 2024-01-14 18:00:00 | 2024-01-11 09:00:00 |

---

### ● Q27 範囲・リスト指定（BETWEEN / IN）

① `id`が2以上4以下のタスクを取得せよ（`BETWEEN`を使用）。

**期待出力**

| id | employee_id | is_done | expires_at | created_at |
|----|------------|---------|------------|------------|
| 2 | 2 | 0 | NULL | 2024-01-10 10:00:00 |
| 3 | 4 | 0 | 2024-01-14 18:00:00 | 2024-01-11 09:00:00 |
| 4 | 4 | 1 | NULL | 2024-01-12 09:00:00 |

② `department_id`が1または2の従業員を取得せよ（`IN`を使用）。

**期待出力**

| id | department_id | name | salary |
|----|--------------|------|--------|
| 1 | 1 | Alice | 370000 |
| 2 | 1 | Bob | 300000 |
| 3 | 2 | Carol | 420000 |

---

### ● Q28 まとめ

① `tasks`テーブルを`employee_id`でグループ化し、タスク総数から`expires_at`が設定されているタスク数を引いた値を`no_expires_count`として取得し、降順で並べよ。

**期待出力**

| employee_id | no_expires_count |
|------------|-----------------|
| 2 | 1 |
| 4 | 1 |
| 1 | 0 |

② `employees`テーブルから `salary > 300000` または `department_id = 2` の従業員を対象に、`department_id`ごとの平均`salary`を整数で丸め、平均が300,000以上のグループを降順で上位2件表示せよ。

**期待出力**

| department_id | avg_salary |
|--------------|-----------|
| 2 | 420000 |
| 1 | 370000 |

---
---

## 5章 DML(応用)

> **テーブル構成:** 4章と同じ `departments`・`employees`・`tasks` を使用するが、JOIN練習のためデータが異なる。

---

### ■ 事前準備

```sql
CREATE DATABASE practice05;
USE practice05;

CREATE TABLE departments (
    id   INT          PRIMARY KEY NOT NULL,
    name VARCHAR(100) NOT NULL
);

CREATE TABLE employees (
    id            INT          PRIMARY KEY NOT NULL,
    department_id INT          NOT NULL,
    name          VARCHAR(100) NOT NULL,
    salary        INT          NOT NULL
);

CREATE TABLE tasks (
    id          INT      PRIMARY KEY NOT NULL,
    employee_id INT      NOT NULL,
    is_done     BOOLEAN  NOT NULL,
    expires_at  DATETIME,
    created_at  DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO departments VALUES (1,'Sales'),(2,'Engineering'),(3,''),(4,'Marketing');

INSERT INTO employees VALUES
    (1, 1, 'Alice', 350000),
    (2, 1, 'Bob',   280000),
    (3, 2, 'Carol', 420000),
    (4, 3, 'Dave',  310000),
    (5, 5, 'Eve',   380000);

INSERT INTO tasks (id, employee_id, is_done, expires_at) VALUES
    (1, 1, TRUE,  '2024-01-15 18:00:00'),
    (2, 2, FALSE, NULL),
    (3, 4, FALSE, '2024-01-14 18:00:00'),
    (4, 4, TRUE,  NULL),
    (5, 6, TRUE,  '2024-01-16 18:00:00');
```

各テーブルを`SELECT`で確認すること。

**departments**

| id | name |
|----|------|
| 1 | Sales |
| 2 | Engineering |
| 3 | （空文字） |
| 4 | Marketing |

**employees**

| id | department_id | name | salary |
|----|--------------|------|--------|
| 1 | 1 | Alice | 350000 |
| 2 | 1 | Bob | 280000 |
| 3 | 2 | Carol | 420000 |
| 4 | 3 | Dave | 310000 |
| 5 | 5 | Eve | 380000 |

**tasks**

| id | employee_id | is_done | expires_at | created_at |
|----|------------|---------|------------|------------|
| 1 | 1 | 1 | 2024-01-15 18:00:00 | (登録時刻) |
| 2 | 2 | 0 | NULL | (登録時刻) |
| 3 | 4 | 0 | 2024-01-14 18:00:00 | (登録時刻) |
| 4 | 4 | 1 | NULL | (登録時刻) |
| 5 | 6 | 1 | 2024-01-16 18:00:00 | (登録時刻) |

---

### ● Q29 結合1（INNER JOIN）

① `employees`と`departments`を`department_id`でINNER JOINし、全列を表示せよ。

**期待出力**（Eveはdepartment_id=5がdepartmentsに存在しないため除外）

| employees.id | department_id | name | salary | departments.id | name |
|-------------|--------------|------|--------|----------------|------|
| 1 | 1 | Alice | 350000 | 1 | Sales |
| 2 | 1 | Bob | 280000 | 1 | Sales |
| 3 | 2 | Carol | 420000 | 2 | Engineering |
| 4 | 3 | Dave | 310000 | 3 | （空文字） |

② `employees`と`tasks`を`employee_id`でINNER JOINし、全列を表示せよ。

**期待出力**（Carol・Eveはtasksに存在しない。tasks.id=5のemployee_id=6はemployeesに存在しない）

| employees.id | department_id | name | salary | tasks.id | employee_id | is_done | expires_at | created_at |
|-------------|--------------|------|--------|---------|------------|---------|------------|------------|
| 1 | 1 | Alice | 350000 | 1 | 1 | 1 | 2024-01-15 18:00:00 | (時刻) |
| 2 | 1 | Bob | 280000 | 2 | 2 | 0 | NULL | (時刻) |
| 4 | 3 | Dave | 310000 | 3 | 4 | 0 | 2024-01-14 18:00:00 | (時刻) |
| 4 | 3 | Dave | 310000 | 4 | 4 | 1 | NULL | (時刻) |

---

### ● Q30 結合2（USING と NATURAL JOIN の落とし穴）

① `employees`と`departments`を`USING (department_id)`でINNER JOINしようとするとどうなるか試せ。エラーになる場合はその理由を考えよ。

> **補足:** `USING`は結合キーの列名が両テーブルで一致している必要がある。`employees.department_id`と`departments.id`では名前が異なるため`USING`は使えない。これがPKを全テーブル`id`で統一した場合のトレードオフ。

② `employees`と`tasks`を`NATURAL JOIN`せよ。

**期待出力**（共通列`employee_id`ではなく`id`で結合されてしまう点に注意）

> **補足:** `employees`と`tasks`の共通列名は`id`と`employee_id`の両方が存在する。`NATURAL JOIN`はすべての共通列で結合するため、`id`も結合条件に含まれ意図しない結果になる。`NATURAL JOIN`は実務では避けるべき。

---

### ● Q31 結合3（LEFT OUTER JOIN）

① `employees`と`departments`をLEFT JOINせよ。

**期待出力**（Eveはdepartments側がNULL）

| employees.id | department_id | name | salary | departments.id | name |
|-------------|--------------|------|--------|----------------|------|
| 1 | 1 | Alice | 350000 | 1 | Sales |
| 2 | 1 | Bob | 280000 | 1 | Sales |
| 3 | 2 | Carol | 420000 | 2 | Engineering |
| 4 | 3 | Dave | 310000 | 3 | （空文字） |
| 5 | 5 | Eve | 380000 | NULL | NULL |

② `employees`と`tasks`をLEFT JOINせよ。

**期待出力**（Carol・EveはTasks側がNULL）

| employees.id | department_id | name | salary | tasks.id | employee_id | is_done | expires_at | created_at |
|-------------|--------------|------|--------|---------|------------|---------|------------|------------|
| 1 | 1 | Alice | 350000 | 1 | 1 | 1 | 2024-01-15 18:00:00 | (時刻) |
| 2 | 1 | Bob | 280000 | 2 | 2 | 0 | NULL | (時刻) |
| 3 | 2 | Carol | 420000 | NULL | NULL | NULL | NULL | NULL |
| 4 | 3 | Dave | 310000 | 3 | 4 | 0 | 2024-01-14 18:00:00 | (時刻) |
| 4 | 3 | Dave | 310000 | 4 | 4 | 1 | NULL | (時刻) |
| 5 | 5 | Eve | 380000 | NULL | NULL | NULL | NULL | NULL |

---

### ● Q32 結合4（FULL OUTER JOIN の代替）

MySQLはFULL OUTER JOINをサポートしていない。LEFT JOINとRIGHT JOINをUNIONして代替せよ。

`employees`と`departments`のFULL OUTER JOIN相当のSQLを書け。

**期待出力**（全employees・全departments。Eveは部署NULL、MarketingはemployeeがNULL）

| employees.id | department_id | name | salary | departments.id | name |
|-------------|--------------|------|--------|----------------|------|
| 1 | 1 | Alice | 350000 | 1 | Sales |
| 2 | 1 | Bob | 280000 | 1 | Sales |
| 3 | 2 | Carol | 420000 | 2 | Engineering |
| 4 | 3 | Dave | 310000 | 3 | （空文字） |
| 5 | 5 | Eve | 380000 | NULL | NULL |
| NULL | NULL | NULL | NULL | 4 | Marketing |

---

### ● Q33 結合5（アンチJOIN）

`employees`と`departments`をLEFT JOINし、対応する部署が存在しない従業員のみを取得せよ。

**期待出力**

| employees.id | department_id | name | salary | departments.id | name |
|-------------|--------------|------|--------|----------------|------|
| 5 | 5 | Eve | 380000 | NULL | NULL |

---

### ● Q34 結合6（自己結合）

`employees`テーブルを自己結合し、同じ`department_id`に属する従業員のペアを表示せよ（同一人物の組み合わせは除く。重複も除く）。

**期待出力**

| a.id | a.name | b.id | b.name | department_id |
|------|--------|------|--------|--------------|
| 1 | Alice | 2 | Bob | 1 |

---

### ● Q35 3テーブルのINNER JOIN

`employees`・`departments`・`tasks`の3テーブルをINNER JOINで結合し、全列を表示せよ。

**期待出力**（tasksを持ち、かつdepartmentsに所属するemployeesのみ）

| e.id | dept_id | e.name | salary | d.id | d.name | t.id | emp_id | is_done | expires_at | created_at |
|------|---------|--------|--------|------|--------|------|--------|---------|------------|------------|
| 1 | 1 | Alice | 350000 | 1 | Sales | 1 | 1 | 1 | 2024-01-15 18:00:00 | (時刻) |
| 2 | 1 | Bob | 280000 | 1 | Sales | 2 | 2 | 0 | NULL | (時刻) |
| 4 | 3 | Dave | 310000 | 3 | （空文字） | 3 | 4 | 0 | 2024-01-14 18:00:00 | (時刻) |
| 4 | 3 | Dave | 310000 | 3 | （空文字） | 4 | 4 | 1 | NULL | (時刻) |

---

### ● Q36 3テーブル結合＋絞り込み1

Q35のSQLを元に、`departments.name = 'Sales'` のレコードのみ表示せよ。

**期待出力**

| e.id | dept_id | e.name | salary | d.id | d.name | t.id | emp_id | is_done | expires_at | created_at |
|------|---------|--------|--------|------|--------|------|--------|---------|------------|------------|
| 1 | 1 | Alice | 350000 | 1 | Sales | 1 | 1 | 1 | 2024-01-15 18:00:00 | (時刻) |
| 2 | 1 | Bob | 280000 | 1 | Sales | 2 | 2 | 0 | NULL | (時刻) |

---

### ● Q37 3テーブル結合＋LEFT JOIN

`employees`と`departments`はINNER JOIN、`employees`と`tasks`はLEFT JOINで結合し、タスクがない従業員も含めて表示せよ。

**期待出力**（CarolはtasksなしでNULL。EveはINNER JOINで除外）

| e.id | dept_id | e.name | salary | d.id | d.name | t.id | emp_id | is_done | expires_at | created_at |
|------|---------|--------|--------|------|--------|------|--------|---------|------------|------------|
| 1 | 1 | Alice | 350000 | 1 | Sales | 1 | 1 | 1 | 2024-01-15 18:00:00 | (時刻) |
| 2 | 1 | Bob | 280000 | 1 | Sales | 2 | 2 | 0 | NULL | (時刻) |
| 3 | 2 | Carol | 420000 | 2 | Engineering | NULL | NULL | NULL | NULL | NULL |
| 4 | 3 | Dave | 310000 | 3 | （空文字） | 3 | 4 | 0 | 2024-01-14 18:00:00 | (時刻) |
| 4 | 3 | Dave | 310000 | 3 | （空文字） | 4 | 4 | 1 | NULL | (時刻) |

---

### ● Q38 3テーブル結合＋LEFT JOIN＋NULLフィルタ

Q37のSQLを元に、タスクが割り当てられていない従業員のみを取得せよ。

**期待出力**

| e.id | dept_id | e.name | salary | d.id | d.name | t.id | emp_id | is_done | expires_at | created_at |
|------|---------|--------|--------|------|--------|------|--------|---------|------------|------------|
| 3 | 2 | Carol | 420000 | 2 | Engineering | NULL | NULL | NULL | NULL | NULL |

---

### ● Q39 JOINを使ったUPDATE

`departments`テーブルの`name`が空文字 `''` のレコードを対象に、対応する`employees`レコードの`name`でUPDATEせよ。更新後、`SELECT`で確認すること。

> **補足:** MySQLのUPDATE ... JOINの構文は `UPDATE テーブルA INNER JOIN テーブルB ON ... SET ...`

**期待出力**（id=3の空文字が'Dave'に更新される）

| id | name |
|----|------|
| 1 | Sales |
| 2 | Engineering |
| 3 | Dave |
| 4 | Marketing |

---

### ■ ここまでのデータ状態

Q39のUPDATE以降、`departments`のid=3のnameは`'Dave'`になっている。

---

### ● Q40 副問合せの基本

`employees`テーブルから、全従業員の平均`salary`より高い`salary`を持つレコードを取得せよ。

> **ヒント:** 全員の平均は 348,000 円

**期待出力**

| id | department_id | name | salary |
|----|--------------|------|--------|
| 1 | 1 | Alice | 350000 |
| 3 | 2 | Carol | 420000 |
| 5 | 5 | Eve | 380000 |

---

### ● Q41 3種類の副問合せ

① FROM句（インラインビュー）：`employees`全件を取得するサブクエリを`FROM`句に置き、`salary > 300000` で絞り込め。

**期待出力**

| id | department_id | name | salary |
|----|--------------|------|--------|
| 1 | 1 | Alice | 350000 |
| 3 | 2 | Carol | 420000 |
| 4 | 3 | Dave | 310000 |
| 5 | 5 | Eve | 380000 |

② WHERE句：`departments`テーブルに存在する`id`を`department_id`として持つ従業員を取得せよ。

**期待出力**

| id | department_id | name | salary |
|----|--------------|------|--------|
| 1 | 1 | Alice | 350000 |
| 2 | 1 | Bob | 280000 |
| 3 | 2 | Carol | 420000 |
| 4 | 3 | Dave | 310000 |

③ SELECT句（スカラサブクエリ）：全従業員の平均`salary`を各行に付加して表示せよ。

**期待出力**

| id | name | salary | avg_salary |
|----|------|--------|-----------|
| 1 | Alice | 350000 | 348000.0 |
| 2 | Bob | 280000 | 348000.0 |
| 3 | Carol | 420000 | 348000.0 |
| 4 | Dave | 310000 | 348000.0 |
| 5 | Eve | 380000 | 348000.0 |

---

### ● Q42 副問合せ同士のJOIN

`salary > 300000` の従業員を取得するサブクエリと、`departments`全件を取得するサブクエリをそれぞれ定義し、`department_id`と`id`でJOINして全列を表示せよ。

**期待出力**

| id | department_id | name | salary | id | name |
|----|--------------|------|--------|----|------|
| 1 | 1 | Alice | 350000 | 1 | Sales |
| 3 | 2 | Carol | 420000 | 2 | Engineering |
| 4 | 3 | Dave | 310000 | 3 | Dave |

---

### ● Q43 IN を使ったサブクエリ

`tasks`テーブルから、`employees`テーブルに存在する`id`と一致する`employee_id`を持つレコードを取得せよ。

**期待出力**（tasks.id=5はemployee_id=6がemployeesに存在しないため除外）

| id | employee_id | is_done | expires_at | created_at |
|----|------------|---------|------------|------------|
| 1 | 1 | 1 | 2024-01-15 18:00:00 | (時刻) |
| 2 | 2 | 0 | NULL | (時刻) |
| 3 | 4 | 0 | 2024-01-14 18:00:00 | (時刻) |
| 4 | 4 | 1 | NULL | (時刻) |

---

### ● Q44 スカラサブクエリ

`employees`テーブルの各レコードに対して、`departments`から対応する`name`をスカラサブクエリで取得し、`dept_name`として表示せよ。

**期待出力**（department_idに対応するdepartmentsのidが存在しない場合はNULL）

| id | name | salary | dept_name |
|----|------|--------|----------|
| 1 | Alice | 350000 | Sales |
| 2 | Bob | 280000 | Sales |
| 3 | Carol | 420000 | Engineering |
| 4 | Dave | 310000 | Dave |
| 5 | Eve | 380000 | NULL |

---

### ● Q45 相関副問合せ

`employees`テーブルから、同じ`department_id`グループの平均`salary`より高い`salary`を持つレコードを取得せよ。

**期待出力**

| id | department_id | name | salary |
|----|--------------|------|--------|
| 1 | 1 | Alice | 350000 |

---

### ● Q46 シンプルな IN

`tasks`テーブルから、`employee_id`が `1`, `2`, `4` のいずれかに一致するレコードを`IN`を使って取得せよ。

**期待出力**

| id | employee_id | is_done | expires_at | created_at |
|----|------------|---------|------------|------------|
| 1 | 1 | 1 | 2024-01-15 18:00:00 | (時刻) |
| 2 | 2 | 0 | NULL | (時刻) |
| 3 | 4 | 0 | 2024-01-14 18:00:00 | (時刻) |
| 4 | 4 | 1 | NULL | (時刻) |

---

### ● Q47 サブクエリを使ったIN

Q43と同じ結果を、`IN`とサブクエリを使って取得せよ。（`= ANY`でも可）

**期待出力**

| id | employee_id | is_done | expires_at | created_at |
|----|------------|---------|------------|------------|
| 1 | 1 | 1 | 2024-01-15 18:00:00 | (時刻) |
| 2 | 2 | 0 | NULL | (時刻) |
| 3 | 4 | 0 | 2024-01-14 18:00:00 | (時刻) |
| 4 | 4 | 1 | NULL | (時刻) |

> **補足:** `= ANY(サブクエリ)` は `IN(サブクエリ)` と同等の動作をする。

---

### ● Q48 ALL を使った副問合せ

`employees`テーブルから、全従業員の`salary`の最大値よりも大きい`salary`を持つレコードを`> ALL`を使って取得せよ（結果が空になることを確認する）。

**期待出力**

```
Empty set
```

> **補足:** `> ALL(サブクエリ)` はサブクエリ内の全ての値より大きい、という条件。最大値を超える値は存在しないため結果が空になる。

---

### ● Q49 シンプルな EXISTS

`employees`テーブルから、`tasks`テーブルに対応レコードが存在する従業員を`EXISTS`を使って取得せよ。

**期待出力**

| id | department_id | name | salary |
|----|--------------|------|--------|
| 1 | 1 | Alice | 350000 |
| 2 | 1 | Bob | 280000 |
| 4 | 3 | Dave | 310000 |

---

### ● Q50 EXISTS と相関副問合せ

`employees`テーブルから、`is_done = TRUE`のタスクを持つ従業員のみを取得せよ。

**期待出力**

| id | department_id | name | salary |
|----|--------------|------|--------|
| 1 | 1 | Alice | 350000 |
| 4 | 3 | Dave | 310000 |

---

### ● Q51 WITH句（CTE）

WITH句を使って`salary > 300000`の従業員を取得するCTEを定義し、さらに`department_id = 1`で絞り込んで表示せよ。

**期待出力**

| id | department_id | name | salary |
|----|--------------|------|--------|
| 1 | 1 | Alice | 350000 |

---

### ● Q52 UNION / UNION ALL

① `departments`の`name`列と`employees`の`name`列を`UNION`で結合せよ（重複排除）。

> **補足:** ORDER BY未指定のため行順は実行環境により異なる場合がある。

**期待出力（一例）**

| name |
|------|
| Alice |
| Bob |
| Carol |
| Dave |
| Engineering |
| Eve |
| Marketing |
| Sales |

② `UNION ALL`で重複を排除せずに結合せよ。

> Q39のUPDATE後、departments.nameの値が Sales / Engineering / Dave / Marketing になっていることに注意。departments側のDaveとemployees側のDaveが重複して出現する。

---

### ● Q53 INTERSECT（共通行の取得）

`departments`の`name`の集合と`employees`の`name`の集合で共通する値を取得せよ。

**期待出力**（Q39後、departments.name='Dave' が employees.name='Dave' と一致）

| name |
|------|
| Dave |

> **バージョン注記:** `INTERSECT`はMySQL 8.0.31以降で利用可能。  
> 旧バージョン対応: `SELECT DISTINCT d.name FROM departments d INNER JOIN employees e ON d.name = e.name`

---

### ● Q54 EXCEPT（差分の取得）

`departments`の`name`の集合から、`employees`の`name`の集合に含まれる値を除いた残りを取得せよ。

**期待出力**

| name |
|------|
| Sales |
| Engineering |
| Marketing |

> **バージョン注記:** `EXCEPT`はMySQL 8.0.31以降で利用可能。  
> 旧バージョン対応: `SELECT DISTINCT d.name FROM departments d LEFT JOIN employees e ON d.name = e.name WHERE e.name IS NULL`

---

### ● Q55 再帰的問い合わせ（WITH RECURSIVE）

`WITH RECURSIVE`を使って1から10までの連番を生成せよ。

**期待出力**

| n |
|---|
| 1 |
| 2 |
| 3 |
| 4 |
| 5 |
| 6 |
| 7 |
| 8 |
| 9 |
| 10 |

---

### ● Q56 クエリ実行計画（EXPLAIN）

① `employees`と`departments`のINNER JOINに`EXPLAIN`を実行し、実行計画を確認せよ。

② MySQL 8.0.18以降では`EXPLAIN ANALYZE`で実際の実行時間も確認できる。同クエリに対して実行せよ。

**期待出力イメージ（EXPLAINの主要列）**

| id | select_type | table | type | key | rows | Extra |
|----|-------------|-------|------|-----|------|-------|
| 1 | SIMPLE | employees | ALL | NULL | 5 | NULL |
| 1 | SIMPLE | departments | ALL | NULL | 4 | Using where; Using join buffer |

> **補足:** `type=ALL`はフルスキャンを意味する。PKにはデフォルトでインデックスが付くため、JOINキーの列名が一致していれば`type=ref`に改善される。

---

### ● Q57 UPSERT（ON DUPLICATE KEY UPDATE）

`tasks`テーブルに `id = 1` のレコードをINSERTしようとした場合に、既存レコードの`is_done`を`FALSE`に更新するSQLを実行せよ。

**期待出力**（is_doneが0に更新される）

| id | employee_id | is_done | expires_at | created_at |
|----|------------|---------|------------|------------|
| 1 | 1 | 0 | 2024-01-15 18:00:00 | (元の時刻) |

---

### ● Q58 まとめ

以下の要件を満たすSQLを1つのクエリで記述せよ。

- `departments`・`employees`・`tasks`を`departments LEFT JOIN employees LEFT JOIN tasks`の順で結合する（`departments.id = employees.department_id`、`employees.id = tasks.employee_id`）
- `salary > 300000` の従業員のみを対象とする
- `department_id`ごとのタスク数（`COUNT(tasks.id)`）を集計する
- タスク数が1件以上のグループのみ表示する
- タスク数の降順で並べ、上位3件を表示する

**期待出力**

| id | name | task_count |
|----|------|-----------|
| 3 | Dave | 2 |
| 1 | Sales | 1 |

---

*以上で4章・5章（MySQL版）の問題は終わりです。*