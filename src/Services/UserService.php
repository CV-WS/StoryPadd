<?php

namespace App\Services;

use App\Manager\AccountManager;
use App\Manager\UserManager;
use App\Models\Account;
use App\Models\User;
use App\Repository\Repository;

class UserService
{
    public function signInVerify(AccountManager $manager, array $post, &$message, Repository $repository, string $role): bool
    {
        if (!$_SERVER["REQUEST_METHOD"] == "POST") {
            return false;
        }

        $email = isset($post["email"]) && !empty($post["email"]) ? $post["email"] : NULL;
        $password = isset($post['password']) && !empty($post['password']) ? $post['password'] : NULL;

        $pattern = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^\w\d\s]).{8,}$/";

        $user = $repository->findOneBy(['email' => $email]);

        if ($user) {
            $message['errors']['phone'] = 'Ce numéro est déja utilisé';
        }


        if (!$email || gettype($email) !== "string" || filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
            $message['errors']['email'] = 'Votre adresse e-mail n\'est pas valide';
        }


        if (!$password || ($password && strlen($password) < 12)) {
            $message['errors']['password'] = 'Votre mot de passe est trop court';
        }

        if ($password && strlen($password) > 30) {
            $message['errors']['password'] = 'Votre mot de passe est trop long';
        }

        if (!$password || ($password && !preg_match($pattern, $password))) {
            $message['errors']['password-regx'] = 'Votre mot de passe doit contenir au moins un majuscule, une minuscule, un chiffre et un caractère spéciale';
        }

        if (count($message['errors']) > 0) {
            return false;
        }

        $password = password_hash($password, PASSWORD_DEFAULT);

        $user = new Account();

        $user->setEmail($email);
        $user->setPassword($password);
        $user->addRoles($role);
        $manager->push($user);

        $message['success'][] = 'Votre compte à bien été enrtegistré. Vous pouvez maintenant vous connecter';
        return true;
    }
}
