<?php

namespace App\Repository;

use App\Database\Database;

class CategoryRepository
{
    private \PDO $pdo;
    private string $table;

    public function __construct()
    {
        $this->pdo = Database::pdo(); // Utilise la connexion de Database.php
        $this->table = 'category';
    }

    public function findAll(): array
    {
        $query = $this->pdo->query("SELECT * FROM {$this->table}");
        return $query->fetchAll(\PDO::FETCH_ASSOC);
    }
}