<?php

namespace App\Manager;

use App\Models\Account;

class AccountManager
{
    private \PDO $pdo;

    public function __construct()
    {
        $this->pdo = \App\Database\Database::pdo();
    }

    public function push(Account $account) {
        $email = $account->getEmail();
        $password = $account->getPassword();
        $roles = json_encode($account->getRoles());
        $validate = FALSE;

        $query = $this->pdo->prepare('INSERT INTO account(email, password, created_at, updated_at, roles, validate) VALUES (:email, :password, now(), null, :roles, :validate)');

        $query->bindParam(':email', $email, \PDO::PARAM_STR);
        $query->bindParam(':password', $password, \PDO::PARAM_STR);
        $query->bindParam(':roles', $roles);
        $query->bindParam(':validate', $validate, \PDO::PARAM_BOOL);

        $query->execute();
    }
}