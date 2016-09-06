<?php

namespace App\Auth\Permission\Models;

use App\Auth\Permission\Exception\RoleNotExistsException;
use App\Models\Traits\FindByName;
use App\Models\Traits\HasPermissions;
use App\Models\User;
use App\Models\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class Role extends Model
{
    use FindByName;
    use HasPermissions;

    public $incrementing = false;

    public $guarded = ['id'];

    protected $table = 'roles';

    /**
     * A role may be given various permissions.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'role_permission');
    }

    /**
     * A role may be assigned to various users.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_role');
    }

    /**
     * Find a role by its name.
     *
     * @param string $name
     *
     * @throws RoleNotExistsException
     *
     * @return Role
     */
    public static function findByName($name)
    {
        try {
            return FindByName::findByName($name);
        } catch (ModelNotFoundException $e) {
            throw new RoleNotExistsException("Role {$name} not exists", 0, $e);
        }
    }

    /**
     * Determine if the user may perform the given permission.
     *
     * @param string|Permission $permission
     *
     * @return bool
     */
    public function hasPermissionTo($permission)
    {
        if (is_string($permission)) {
            $permission = Permission::findByName($permission);
        }

        return $this->permissions->contains('id', $permission->id);
    }
}