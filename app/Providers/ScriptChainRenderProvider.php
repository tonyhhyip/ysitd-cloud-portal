<?php

namespace App\Providers;

use App\Helper\Scripts\Loader;
use App\Helper\Scripts\Loaders\CacheLoader;
use App\Helper\Scripts\Loaders\JsonFileLoader;
use App\Helper\Scripts\Presenter;
use App\Helper\Scripts\Presenters\DeferScriptPresenter;
use App\Helper\Scripts\Presenters\ScriptPresenter;
use Illuminate\Cache\Repository;
use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;

class ScriptChainRenderProvider extends ServiceProvider
{
    protected $defer = true;

    public function register()
    {
        $this->app->singleton(Loader::class, function (Application $app) {
            $loader = new JsonFileLoader($app['files']);
            return new CacheLoader($app[Repository::class], $loader);
        });

        $this->app->bind(Presenter::class, function (Application $app) {
            $loader = $app->make(Loader::class);
            $presenter =  new ScriptPresenter();
            $presenter->addLoader($loader);
            return $presenter;
        });

        $this->app->singleton(DeferScriptPresenter::class, function (Application $app) {
            $loader = $app->make(Loader::class);
            $presenter =  new DeferScriptPresenter();
            $presenter->addLoader($loader);
            return $presenter;
        });
    }

    public function provides()
    {
        return [Loader::class, Presenter::class];
    }
}