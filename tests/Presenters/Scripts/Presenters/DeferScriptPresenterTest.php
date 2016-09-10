<?php

namespace Tests\Scripts\Presenters;

use App\Presenters\Scripts\Loader;
use App\Presenters\Scripts\Presenters\DeferScriptPresenter;
use Illuminate\Support\Str;

class DeferScriptPresenterTest extends \TestCase
{
    const VUE_SRC = 'https://cdnjs.cloudflare.com/ajax/libs/vue/1.0.26/vue.min.js';

    public function testConstruct()
    {
        $instance = $this->app->make(DeferScriptPresenter::class);
        $loader = $this->app->make(Loader::class);
        $this->assertInstanceOf(DeferScriptPresenter::class, $instance);
        $this->assertAttributeCount(1, 'loaders', $instance);
        $this->assertAttributeEquals([$loader], 'loaders', $instance);
    }

    public function testRenderScript()
    {
        $instance = new DeferScriptPresenter;
        $result = $this->invokeMethod($instance, 'renderScript', [static::VUE_SRC]);
        $expect = '<script defer src="' . static::VUE_SRC . '"></script>';
        $this->assertEquals($expect, $result);
    }

    public function testResolveScript()
    {
        $instance = $this->app->make(DeferScriptPresenter::class);
        $result = $this->invokeMethod($instance, 'resolveScript', ['vue']);
        $this->assertInternalType('array', $result);
        $this->assertEquals([static::VUE_SRC], $result);
    }

    public function testResolveRequired()
    {
        $instance = $this->app->make(DeferScriptPresenter::class);
        $this->invokeMethod($instance, 'resolveRequired', [['vue', 'jquery']]);
        $this->assertAttributeInternalType('array', 'scripts', $instance);
        $this->assertAttributeContains(static::VUE_SRC, 'scripts', $instance);
    }

    public function testRender()
    {
        $instance = $this->app->make(DeferScriptPresenter::class);
        $this->invokeMethod($instance, 'resolveRequired', [['vue']]);
        $result = $this->invokeMethod($instance, 'render');
        $this->assertTrue(Str::contains($result, static::VUE_SRC));
    }

    public function testProvide()
    {
        $instance = $this->app->make(DeferScriptPresenter::class);
        $result = $instance->provide('vue');
        $this->assertTrue(Str::contains($result, static::VUE_SRC));
    }
}
