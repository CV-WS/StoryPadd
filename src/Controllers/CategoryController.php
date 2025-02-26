<?php

namespace App\Controllers;

use App\Controllers\Controller;
use App\Manager\CategoryManager;

class CategoryController extends Controller
{
    public function category(CategoryManager $manager)
    {
        $categories = $manager->getAllCategories(); // Récupération des catégories
        $this->render('category/category', ['categories' => $categories]);
    }
}
