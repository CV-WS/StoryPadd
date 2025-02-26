<?php

namespace App\Repository;

use App\Database\Database;


class Repository
{
    protected \PDO $pdo;
    protected string|null $table = null;

    public function __construct()
    {
        $this->pdo = Database::pdo();
    }

    public function findAll(): array
    {
        $query = $this->pdo->prepare("SELECT * FROM $this->table");
        $query->execute();
        return $query->fetchAll();
    }

    public function findOneBy(array $criterias)
    {
        $were = null;
        $i=0;
        foreach($criterias as $key => $criteria) {
            if($i === 0) {
                $were = $key .' = '. ':'.$key; // first_name = :firstname
            } else {
                $were = $were . ' AND ' . $key .' = '. ':'.$key; // AND last_name = :last_name
            }
            $i++;
        }

        // first_name = :firstname AND last_name = :last_name

        if($were === null) {
            return null;
        }

        $query = $this->pdo->prepare("SELECT * FROM $this->table WHERE $were");
//        $query = $this->pdo->prepare("SELECT * FROM user WHERE first_name = :firstname AND last_name = :last_name");

        foreach($criterias as $key => $criteria) {
            if (is_int($criteria)) {
                $param = \PDO::PARAM_INT;
            }  elseif (is_bool($criteria)) {
                $param = \PDO::PARAM_BOOL;
            } else {
                $param = \PDO::PARAM_STR;
            }

            $query->bindValue(':'.$key, $criteria, $param);
//            $query->bindValue(':first_name', 'bryan', \PDO::PARAM_STR);
        }

        $query->execute();
        return $query->fetch();
    }

    public function findBy(array $criterias)
    {
        $were = null;
        $i=0;
        foreach($criterias as $key => $criteria) {
            if($i === 0) {
                $were = $key .' = '. ':'.$key; // first_name = :firstname
            } else {
                $were = $were . ' AND ' . $key .' = '. ':'.$key; // AND last_name = :last_name
            }
            $i++;
        }

        // first_name = :firstname AND last_name = :last_name

        if($were === null) {
            return null;
        }

        $query = $this->pdo->prepare("SELECT * FROM $this->table WHERE $were");
//        $query = $this->pdo->prepare("SELECT * FROM user WHERE first_name = :firstname AND last_name = :last_name");

        foreach($criterias as $key => $criteria) {
            if (is_int($criteria)) {
                $param = \PDO::PARAM_INT;
            }  elseif (is_bool($criteria)) {
                $param = \PDO::PARAM_BOOL;
            } else {
                $param = \PDO::PARAM_STR;
            }

            $query->bindValue(':'.$key, $criteria, $param);
//            $query->bindValue(':first_name', 'bryan', \PDO::PARAM_STR);
        }

        $query->execute();
        return $query->fetchAll();
    }
}
