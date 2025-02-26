<?php

namespace App\Repository;
use App\Models\User;

class UserRepository extends Repository {

    public function __construct()
    {
        parent::__construct();
        $this->table = 'user';
    }
}
