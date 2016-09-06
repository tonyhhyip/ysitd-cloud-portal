<?php

namespace App\Models\Traits;

use App\Auth\Permission\Models\Permission;

trait HasPermissions
{
    use Cacheable;

    /**
     * Grant the given permission(s) to a role.
     *
     * @param string|array|Permission|\Illuminate\Support\Collection $permissions
     *
     * @return HasPermissions
     */
    public function givePermissionTo(...$permissions)
    {
        $permissions = collect($permissions)
            ->flatten()
            ->map(function ($permission) {
                return $this->getStoredPermission($permission);
            })
            ->all();

        $this->permissions()->saveMany($permissions);

        $this->forgetCached();

        return $this;
    }

    /**
     * Remove all current permissions and set the given ones.
     *
     * @param array ...$permissions
     *
     * @return $this
     */
    public function syncPermissions(...$permissions)
    {
        $this->permissions()->detach();
        return $this->givePermissionTo($permissions);
    }

    /**
     * Revoke the given permission.
     *
     * @param $permission
     *
     * @return HasPermissions
     */
    public function revokePermissionTo($permission)
    {
        $this->permissions()->detach($this->getStoredPermission($permission));
        $this->forgetCachedPermissions();
        return $this;
    }

    /**
     * @param string|array|Permission|\Illuminate\Support\Collection $permissions
     *
     * @return Permission
     */
    protected function getStoredPermission($permissions)
    {
        if (is_string($permissions)) {
            return Permission::findByName($permissions);
        }
        if (is_array($permissions)) {
            return Permission::whereIn('name', $permissions)->get();
        }
        return $permissions;
    }
}