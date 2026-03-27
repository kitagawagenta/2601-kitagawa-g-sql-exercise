<?php

namespace App\Questions;

use PDO;

class Q55 extends BaseQuestion
{
    public function execute(): void
    {
        $pdo = $this->getPdo();

        $sql = "
            WITH RECURSIVE numbers AS (
                SELECT 1 AS n
                UNION ALL
                SELECT n + 1
                FROM numbers
                WHERE n < 10
            )
            SELECT n
            FROM numbers
        ";

        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $this->displayTable($rows);
    }
}
