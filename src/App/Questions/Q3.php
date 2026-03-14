<?php

namespace App\Questions;

use PDO;

class Q3 extends BaseQuestion
{
public function execute(): void
{
$sql = "
    INSERT INTO tasks 
        (id, employee_id, is_done, expires_at, created_at)
    VALUES 
        (5, 1, TRUE, '2024-01-16 18:00:00', '2024-01-13 09:00:00')
";
    $this->getPdo()->exec($sql);

    $this->queryAndDisplay("SELECT * FROM tasks", "tasks");
}
}