<?php

namespace App\Auth\Permission\Models;

use App\Auth\Permission\Exception\PermissionNotExistsException;
use App\Models\Traits\Cacheable;
use App\Models\Traits\FindByName;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class Permission extends Model
{
    use FindByName {
        findByName as findWithName;
    }
    use Cacheable;

    public $incrementing = false;

    public $guarded = ['id'];

    protected $table = 'permissions';

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_permission');
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_permission');
    }

    /**
     * @param string $name
     *
     * @return static
     */
    public static function findByName($name)
    {
        try {
            return static::findWithName($name);
        } catch (ModelNotFoundException $e) {
            throw new PermissionNotExistsException("Role {$name} not exists", 0, $e);
        }
    }
}