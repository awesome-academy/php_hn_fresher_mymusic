<?php

$common = [
    'role' => [],
    'active' => [],
];

$common['role'][config('common.role.admin')] = 'Quản trị viên';
$common['role'][config('common.role.user')] = 'Người dùng';

$common['active'][config('common.status.active')] = 'Kích hoạt';
$common['active'][config('common.status.block')] = 'Đã bị chặn';

return $common;
