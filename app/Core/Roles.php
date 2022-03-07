<?php

namespace App\Core;

use App\Models\Role;

/**
 * Extends the User Model by providing helpers regarding the Role system
 */
trait Roles
{
    /**
     * Does the user have the specified role?
     * @param string $role
     * @return bool
     */
    public function hasRole(string $role): bool
    {
        return $this->roles->contains(Role::where(['key' => $role])->first());
    }

    /**
     * The roles that are considered belonging to Staff
     * These have access to the Dashboard
     *
     * @var array
     */
    protected array $staffRoles = [
        'admin',
        'mod',
        'vol',
        'worker',
    ];

    /**
     * Does the user belong to a Staff Role?
     * @return bool
     */
    public function isStaff(): bool
    {
        return (bool) array_intersect($this->roles->pluck('key')->toArray(), $this->staffRoles);
    }
}
