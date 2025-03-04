<?php

namespace App\Controllers;

use App\Manager\AccountManager;
use App\Manager\UserManager;
use App\Models\Account;
use App\Models\User;
use App\Repository\AccountRepository;
use App\Repository\UserRepository;
use App\Services\MailerService;
use App\Services\RoleService;
use App\Services\UserService;

class UserController extends Controller
{

    public function sign_in(AccountManager $manager, UserService $userService, AccountRepository $userRepository, MailerService $mailer, $role)
    {
        if (!array_key_exists($role, RoleService::ROLES)) {
            dd('role existe pas');
        }

        $message = ['errors' => [], 'success' => []];
        $account = new Account();

        if ($userService->signInVerify($manager, $_POST, $message, $userRepository, $role, $account)) {
            $mailer->send($account->getEmail());
            return $this->redirect('user', 'email_link');
        }

        return $this->render('/user/sign_in', ['message' => $message]);
    }

    public function email_link() {
        return $this->render('/user/email_link');
    }

    public function connexion(AccountRepository $repository)
    {
        $message = ['errors' => [], 'success' => []];
        // Tout es OK

        // On verifie si le formumaire à été soumis
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // On verifie les les données reçu
            $email = isset($_POST['email']) && !empty($_POST['email']) ? $_POST['email'] : NULL;
            $password = isset($_POST['password']) && !empty($_POST['password']) ? $_POST['password'] : NULL;

            if (!$email || gettype($email) != 'string') {
                $message['errors']['email'] = 'Le champ est vide';
            }

            if (!$password || gettype($password) != 'string') {
                $message['errors']['password'] = 'Le champ est vide';
            }

            $userRepository = $repository->findOneBy(['email' => $email]);

            if (!$userRepository) {
                $message['errors']['user'] = 'L\'email ou le password est incorrect';
            }

            if ($userRepository) {
                //Créer et instancier User
                $user = new Account();
                $user->setEmail($userRepository['email']);
                $user->setId($userRepository['id']);
                $user->setPassword($userRepository['password']);
                $user->setRoles(json_decode($userRepository['roles']));

                // On verifie le password
                if (!password_verify($password, $userRepository['password'])) {
                    $message['errors']['user'] = 'L\'email ou le password est incorrect';
                }
            }


            if (count($message['errors']) === 0) {
                $_SESSION['email'] = $user->getEmail();
                $_SESSION['id'] = $user->getId();
                $_SESSION['roles'] = $user->getRoles();

                $this->redirect('home','index', ['message' => $message]);
            }
        }
        return $this->render('/user/connexion');
    }

    public function show_selected_role() {
        return $this->render('/user/role');
    }
}
