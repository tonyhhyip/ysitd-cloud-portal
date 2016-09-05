<?php

namespace App\Providers;

use App\Helper\Scripts\Loader;
use App\Helper\Scripts\Loaders\CacheLoader;
use App\Helper\Scripts\Loaders\JsonFileLoader;
use App\Helper\Scripts\Presenter;
use App\Helper\Scripts\Presenters\DeferScriptPresenter;
use App\Helper\Scripts\Presenters\ScriptPresenter;
use Illuminate\Cache\Repository;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;

class ScriptChainRenderProvider extends ServiceProvider
{
    protected $defer = true;

    public function register()
    {

        $this->app->singleton(JsonFileLoader::class, function () {
            $file = $this->app->make(Filesystem::class);
            return new JsonFileLoader($file);
        });

        $this->app->singleton(CacheLoader::class, function () {
            $loader = $this->app->make(JsonFileLoader::class);
            return new CacheLoader($this->app->make(Repository::class), $loader);
        });

        $this->app->bind(Loader::class, CacheLoader::class);

        $this->app->bind(Presenter::class, function () {
            $loader = $this->app->make(Loader::class);
            $presenter =  new ScriptPresenter();
            $presenter->addLoader($loader);
            return $presenter;
        });

        $this->app->singleton(DeferScriptPresenter::class, function () {
            $loader = $this->app->make(Loader::class);
            $presenter =  new DeferScriptPresenter();
            $presenter->addLoader($loader);
            return $presenter;
        });

    }

    public function provides()
    {
        return [
            Loader::class, Presenter::class, DeferScriptPresenter::class, JsonFileLoader::class,
            'script.presenter.defer'
        ];
    }
}