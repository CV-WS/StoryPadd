<?php

namespace App\Controllers;

use App\Controllers\Controller;

class PersonalspaceController extends Controller
{
    public function profile()
    {
        return $this->render('/personalspace/profile');
    }
}