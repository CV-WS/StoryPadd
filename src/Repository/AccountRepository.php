<?php

namespace App\Repository;

class AccountRepository extends Repository {

    public function __construct()
    {
        parent::__construct();
        $this->table = 'account';
    }
}
