<?php

namespace App\Manager;

use App\Models\User;

class UserManager
{
    private \PDO $pdo;

    public function __construct()
    {
        $this->pdo = \App\Database\Database::pdo();
    }

    public function push(User $user) {
        $firstName = $user->getFirstname();
        $lastName = $user->getLastname();
        $phone = $user->getPhone();
        $siret = $user->getSiret();
        $company = $user->getCompany();
        $address = $user->getAddress();
        $postalCode = $user->getPostalCode();
        $city = $user->getCity();
        $birthday = $user->getBirthday();
        $createdAt = $user->getCreatedAt();
        $updatedAt = $user->getUpdatedAt();

        $query = $this->pdo->prepare('INSERT INTO user(firstname, lastname, phone, siret, company, address, postal_code, city, birthday, created_at, update_at) VALUES (:firstname, :lastname, :phone, :siret, :company, :address, :postalCode, :city, :birthday, :createdAt, :updateAt)');

        $query->bindParam(':firstname', $firstName, \PDO::PARAM_STR);
        $query->bindParam(':lastname', $lastName, \PDO::PARAM_STR);
        $query->bindParam(':phone', $phone, \PDO::PARAM_STR);
        $query->bindParam(':siret', $siret, \PDO::PARAM_STR);
        $query->bindParam(':company', $company, \PDO::PARAM_STR);
        $query->bindParam(':postalCode', $postalCode, \PDO::PARAM_STR);
        $query->bindParam(':city', $city, \PDO::PARAM_STR);
        $query->bindParam(':address', $address, \PDO::PARAM_STR);
        $query->bindParam(':birthday', $birthday, \PDO::PARAM_STR);
        $query->bindParam(':createdAt', $createdAt, \PDO::PARAM_STR);
        $query->bindParam(':updatedAt', $updatedAt, \PDO::PARAM_STR);

        $query->execute();
    }
}
