<?php

namespace App\Auth\Permission;

use Exception;
use App\Auth\Permission\Models\Permission;
use Illuminate\Contracts\Auth\Access\Gate;
use Illuminate\Contracts\Cache\Repository;
use Illuminate\Log\Writer;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\Compilers\BladeCompiler;

class PermissionServiceProvider extends ServiceProvider
{
    public function boot(Gate $gate, Repository $cache, Writer $logger)
    {
        try {
            $this->loadPermission($cache)->map(function ($permission) use($gate) {
                $gate->define($permission->name, function ($user) use ($permission) {
                   return $user->hasPermissionTo($permission);
                });
            });
        } catch (Exception $e) {
            $logger->warning('Could not register permissions');
        }
    }

    /**
     * @param Repository $cache
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    private function loadPermission(Repository $cache)
    {
        return $cache->rememberForever('permission.cache', function () {
            return Permission::with('roles')->get();
        });
    }
    
    public function register()
    {
        $this->registerBladeExtensions();
    }

    private function registerBladeExtensions()
    {
        $this->app->afterResolving('blade.compiler', function (BladeCompiler $compiler) {
            $compiler->directive('role', function ($role) {
                return "<?php if(auth()->check() && auth()->user()->hasRole({$role})): ?>";
            });

            $compiler->directive('endrole', function () {
                return '<?php endif; ?>';
            });

            $compiler->directive('hasrole', function ($role) {
                return "<?php if(auth()->check() && auth()->user()->hasRole({$role})): ?>";
            });
            $compiler->directive('endhasrole', function () {
                return '<?php endif; ?>';
            });
            $compiler->directive('hasanyrole', function ($roles) {
                return "<?php if(auth()->check() && auth()->user()->hasAnyRole({$roles})): ?>";
            });
            $compiler->directive('endhasanyrole', function () {
                return '<?php endif; ?>';
            });
            $compiler->directive('hasallroles', function ($roles) {
                return "<?php if(auth()->check() && auth()->user()->hasAllRoles({$roles})): ?>";
            });
            $compiler->directive('endhasallroles', function () {
                return '<?php endif; ?>';
            });
        });
    }
}