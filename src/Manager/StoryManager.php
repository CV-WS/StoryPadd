<?php

namespace App\Manager;

class StoryManager
{
    private \PDO $pdo;

    public function __construct()
    {
        $this->pdo = \App\Database\Database::pdo();
    }

    public function show()
    {

    }

    public function push()
    {

    }

    public function remove(){

    }

    public function delete()
    {

    }
}