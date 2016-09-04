<?php

namespace App\Providers;

use App\Helper\Scripts\Presenters\DeferScriptPresenter;
use Illuminate\Database\Events\QueryExecuted;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     * @param DeferScriptPresenter $presenter
     * @return void
     */
    public function boot(DeferScriptPresenter $presenter)
    {
        $this->bootViewer($presenter);
        if (config('app.verbose')) {
            $this->bindDBDebugListener();
        }
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bind variables to view
     * @param DeferScriptPresenter $presenter
     */
    protected function bootViewer(DeferScriptPresenter $presenter)
    {
        view()->composer('*', function ($view) use ($presenter) {
            $view->with('user', Auth::user());
            $view->with('scripts', $presenter);
        });
    }

    /**
     * Bind Listener to dump SQL to log
     */
    private function bindDBDebugListener()
    {
        DB::listen(function (QueryExecuted $event) {
            $message = sprintf(
                '%s Query run: %s; parameter: %s',
                $event->connectionName,
                $event->sql,
                json_encode($event->bindings)
            );

            Log::debug($message);
        });
    }
}
