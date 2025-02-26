<?php

namespace App\Controllers;

use App\Repository\AccountRepository;
use App\Services\RoleService;

class HomeController extends Controller
{
    public function index(AccountRepository $accountRepository, RoleService $roleService)
    {
//        $user = $accountRepository->findOneBy(['id'=> $_SESSION['id']]);
//
//        if (!$roleService->is_granted('reader', $user)) {
//            dd('ok');
//        }
       $this->render('home/index');
    }
}
