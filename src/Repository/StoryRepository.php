<?php

namespace App\Repository;

use App\Repository\Repository;

class StoryRepository extends Repository
{
    public function __construct()
    {
        parent::__construct(); // Appelle le constructeur du parent pour initialiser $pdo
        $this->table = 'story';
    }

    public function findAll(): array
    {
        $query = $this->pdo->query("SELECT * FROM {$this->table}");
        return $query->fetchAll(\PDO::FETCH_ASSOC);
    }
}