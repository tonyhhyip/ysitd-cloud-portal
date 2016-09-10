<?php

namespace App\Providers;

use App\Presenters\Scripts\Loader;
use App\Presenters\Scripts\Loaders\CacheLoader;
use App\Presenters\Scripts\Loaders\JsonFileLoader;
use App\Presenters\Scripts\Presenter;
use App\Presenters\Scripts\Presenters\DeferScriptPresenter;
use App\Presenters\Scripts\Presenters\ScriptPresenter;
use Illuminate\Support\ServiceProvider;

class ScriptChainRenderProvider extends ServiceProvider
{
    protected $defer = true;

    public function register()
    {
        $this->app->bind(Loader::class, CacheLoader::class);

        $this->app->when(CacheLoader::class)
            ->needs(Loader::class)
            ->give(JsonFileLoader::class);

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
            Loader::class, Presenter::class,
            DeferScriptPresenter::class, JsonFileLoader::class,
        ];
    }
}