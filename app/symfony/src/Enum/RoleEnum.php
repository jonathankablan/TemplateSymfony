<?php

declare(strict_types=1);

namespace App\Enum;

class RoleEnum extends EnumAbstract
{
    public const ROLE_USER = 'ROLE_USER';
    public const ROLE_ADMIN = 'ROLE_ADMIN';
    public const ROLE_MONITOR = 'ROLE_MONITOR';
    public const ROLE_SUPER_ADMIN = 'ROLE_SUPER_ADMIN';

    public const PRIORITIES = [
        self::ROLE_USER,
        self::ROLE_ADMIN,
        self::ROLE_MONITOR,
    ];

    public const PRIORITIES_TRANS_KEYS = [
        self::ROLE_USER => 'label.user',
        self::ROLE_ADMIN => 'label.admin',
        self::ROLE_MONITOR => 'label.monitor',
    ];
}