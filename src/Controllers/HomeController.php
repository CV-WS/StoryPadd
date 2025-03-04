<?php

namespace App\Controllers;

use App\Repository\AccountRepository;
use App\Services\RoleService;
use App\Repository\StoryRepository;

class HomeController extends Controller
{
//    public function index(AccountRepository $accountRepository, RoleService $roleService)
//    {
////        $user = $accountRepository->findOneBy(['id'=> $_SESSION['id']]);
////
////        if (!$roleService->is_granted('reader', $user)) {
////            dd('ok');
////        }
//    }
        public function index(StoryRepository $storyRepository)
    {
        $storyRepository = new StoryRepository(); // Instanciation manuelle si pas de conteneur d'injection
        $stories = $storyRepository->findAll();
        $this->render('home/index', ['stories' => $stories]);
    }

}
