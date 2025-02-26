<?php

namespace App\Services;

use App\Models\Account;
use App\Models\User;

class RoleService {

    public const ROLES = [
        'reader' => ['reader'],
        'writer' => [
            'writer',
            'reader'
        ],
        'company' => [
           'company',
           'reader'
        ],
        'admin' => [
            'admin',
            'reader',
            'writer',
            'company'
        ]
    ];

    public function is_granted(string $role, array $user): bool {

        $roles = json_decode($user['roles']);
        $access = false;

        foreach ($roles as $value) {
            if (in_array($role, self::ROLES[$value])) {
                $access = true;
                break;
            }
        }

        return $access;
    }
}
