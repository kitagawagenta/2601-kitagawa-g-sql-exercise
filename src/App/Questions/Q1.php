<?php

namespace App\Questions;

class Q1 extends BaseQuestion
{
    public function execute(): void
    {
        $tables = ['departments', 'employees', 'tasks'];

        foreach ($tables as $table) {
            $this->queryAndDisplay("SELECT * FROM {$table}", $table);
            echo "\n";
        }
    }
}
