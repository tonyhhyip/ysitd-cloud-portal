<?php

namespace Tests\Scripts\Loaders;

use App\Helper\Scripts\Loaders\JsonFileLoader;
use Illuminate\Support\Facades\File;

class JsonFileLoaderTest extends \TestCase
{
    const VUE_URL = 'https://cdnjs.cloudflare.com/ajax/libs/vue/1.0.26/vue.min.js';

    public function testConstruct()
    {
        $storage = File::getFacadeRoot();
        $instance = new JsonFileLoader($storage);
        $this->assertInstanceOf(JsonFileLoader::class, $instance);
        $this->assertAttributeEquals(storage_path('app/scripts.json'), 'cachePath', $instance);
        $this->assertAttributeEquals(resource_path('assets/js/scripts.json'), 'appPath', $instance);
        $this->assertAttributeEquals($storage, 'file', $instance);
    }

    public function testKnow()
    {
        $storage = File::getFacadeRoot();
        $instance = new JsonFileLoader($storage);
        $this->assertTrue($instance->know('vue'));
        $this->assertFalse($instance->know('foobar'));
    }

    public function testGetHostUrl()
    {
        $storage = File::getFacadeRoot();
        $instance = new JsonFileLoader($storage);
        $result = $this->invokeMethod($instance, 'getHostUrl', [['library' => 'app']]);
        $this->assertEquals(url('js/app.min.js'), $result);
    }

    public function testGetCdnjsUrl()
    {
        $storage = File::getFacadeRoot();
        $instance = new JsonFileLoader($storage);
        $result = $this->invokeMethod($instance, 'getCdnjsUrl', [
            [
                'library' => 'vue',
                'version' => '1.0.26',
                'file' => 'vue'
            ]
        ]);
        $this->assertEquals(static::VUE_URL, $result);
    }

    public function testResolveUrl()
    {
        $storage = File::getFacadeRoot();
        $instance = new JsonFileLoader($storage);
        $result = $this->invokeMethod($instance, 'resolveUrl', [
            'cdnjs://vue:1.0.26@vue'
        ]);
        $this->assertEquals(static::VUE_URL, $result);

        $result = $this->invokeMethod($instance, 'resolveUrl', [
            'host://app'
        ]);
        $this->assertEquals(url('js/app.min.js'), $result);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testInvalidFormat()
    {
        $storage = File::getFacadeRoot();
        $instance = new JsonFileLoader($storage);
        $this->invokeMethod($instance, 'resolveUrl', [
            'foo.bar'
        ]);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testUnsupportProtocol()
    {
        $storage = File::getFacadeRoot();
        $instance = new JsonFileLoader($storage);
        $this->invokeMethod($instance, 'resolveUrl', [
            'foo://bar'
        ]);
    }

    public function testLoadData()
    {
        $storage = File::getFacadeRoot();
        $instance = new JsonFileLoader($storage);
        $this->invokeMethod($instance, 'loadData');
        $this->assertAttributeEquals(true, 'dataLoaded', $instance);
    }

    public function testFind()
    {
        $storage = File::getFacadeRoot();
        $instance = new JsonFileLoader($storage);
        $result = $this->invokeMethod($instance, 'find', ['vue']);
        $this->assertInternalType('array', $result);
        $this->assertEquals([static::VUE_URL], $result);

        $result = $this->invokeMethod($instance, 'find', ['vuex']);
        $this->assertInternalType('array', $result);
        $this->assertEquals(2, count($result));
        $this->assertContains(static::VUE_URL, $result);

        $result = $this->invokeMethod($instance, 'find', ['issue']);
        $this->assertInternalType('array', $result);
        $this->assertGreaterThan(5, count($result));
    }
}
