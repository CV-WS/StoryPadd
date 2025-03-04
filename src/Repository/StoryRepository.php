<?php

namespace App\Repository;

use App\Repository\Repository;

class StoryRepository extends Repository
{
    public function __construct()
    {
        parent::__construct();
        $this->table = 'story';
    }
}