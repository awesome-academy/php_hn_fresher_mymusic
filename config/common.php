<?php

use App\Models\User;

return [
    'role' => [
        'admin' => User::ROLE_ADMIN,
        'user' => User::ROLE_USER,
    ],
    'status' => [
        'active' => User::USER_ACTIVE,
        'block' => User::USER_UNACTIVE,
    ],
];
