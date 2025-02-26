<?php

namespace App\Database;

class Database
{
    public static function pdo(): \PDO
    {
        return new \PDO(
            'mysql:host=db;port=3306;dbname=storypadd;charset=utf8',
            'root',
            'root',
            [
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC
            ]
        );
    }
}