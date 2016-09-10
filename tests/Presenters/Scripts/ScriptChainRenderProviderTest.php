<?php

namespace Tests\Scripts;

use App\Presenters\Scripts\Loader;
use App\Presenters\Scripts\Presenter;
use App\Presenters\Scripts\Presenters\DeferScriptPresenter;

class ScriptChainRenderProviderTest extends \TestCase
{
    public function testLoader()
    {
        $instance = $this->app->make(Loader::class);
        $this->assertInstanceOf(Loader::class, $instance);
    }

    public function testPresenter()
    {
        $instance = $this->app->make(Presenter::class);
        $this->assertInstanceOf(Presenter::class, $instance);
    }

    public function testDeferScriptPresenter()
    {
        $instance = $this->app->make(DeferScriptPresenter::class);
        $this->assertInstanceOf(DeferScriptPresenter::class, $instance);
    }
}
