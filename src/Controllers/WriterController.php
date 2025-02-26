<?php

namespace App\Controllers;

use App\Manager\CategoryManager;
use App\Controllers\Controller;

class WriterController extends Controller
{
    public function writing()
    {
        $categoryManager = new CategoryManager();
        $categories = $categoryManager->getAllCategories();

        return $this->render('writer/writing', ['categories' => $categories]);
    }

}
