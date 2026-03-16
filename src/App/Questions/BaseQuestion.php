<?php

namespace App\Questions;

use PDO;

abstract class BaseQuestion
{
    protected function getPdo(): PDO
    {
        // namespace App 内の Connection クラスをフルパスで叩く
        return \App\Connection::getPdo();
    }

    protected function displayTable(array $rows): void
    {
        if (empty($rows)) return;
        $columns = array_keys($rows[0]);
        echo "|" . implode("|", $columns) . "|\n";
        echo "|" . implode("|", array_fill(0, count($columns), "---")) . "|\n";
        foreach ($rows as $row) {
            $displayRow = array_map(fn($value) => $value === null ? 'NULL' : $value, $row);
            echo "|" . implode("|", $displayRow) . "|\n";
        }
    }

    protected function queryAndDisplay(string $sql, string $tableName = ''): void
    {
        if ($tableName !== '') echo "{$tableName}\n";
        $pdo = $this->getPdo();
        $stmt = $pdo->query($sql);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $this->displayTable($rows);
    }
}