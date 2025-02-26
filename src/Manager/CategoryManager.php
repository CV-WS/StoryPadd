<?php

namespace App\Manager;

use App\Repository\CategoryRepository;

class CategoryManager
{
    private CategoryRepository $categoryRepository;

    public function __construct()
    {
        $this->categoryRepository = new CategoryRepository();
    }

    public function getAllCategories(): array
    {
        return $this->categoryRepository->findAll();
    }
}