<?php

namespace App\Enums;

enum Permission
{
    public const SUPER_ADMIN = 'super_admin';
    public const STORE_OWNER = 'store_owner';
    public const STAFF = 'staff';
    public const CUSTOMER = 'customer';
}
