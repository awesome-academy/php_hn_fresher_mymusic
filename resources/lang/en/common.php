<?php

$common = [
    'role' => [],
    'active' => [],
];

$common['role'][config('common.role.admin')] = 'Admin';
$common['role'][config('common.role.user')] = 'User';

$common['active'][config('common.status.active')] = 'Active';
$common['active'][config('common.status.block')] = 'Blocked';

return $common;
