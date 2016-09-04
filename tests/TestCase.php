<?php

use Illuminate\Contracts\Console\Kernel;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

class TestCase extends BaseTestCase
{
    /**
     * The base URL to use while testing the application.
     *
     * @var string
     */
    protected $baseUrl = 'http://localhost';

    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        $app = require __DIR__ . '/../bootstrap/app.php';

        $app->make(Kernel::class)->bootstrap();

        return $app;
    }

    protected function checkNavbarExists()
    {
        $this->see('User');
        $this->see('Market');
        $this->see('Issue');
        $this->see('Documentation');
    }

    protected function checkHeaderExists()
    {
        $this->see('YSITD Cloud');
    }

    protected function checkFooterExists()
    {
        $this->see('YSITD Cloud Portal');
    }

    protected function checkLayout()
    {
        $this->checkNavbarExists();
        $this->checkHeaderExists();
        $this->checkFooterExists();
    }

    protected function invokeMethod(&$object, $methodName, array $parameters = [])
    {
        $reflection = new \ReflectionClass(get_class($object));
        $method = $reflection->getMethod($methodName);
        $method->setAccessible(true);

        return $method->invokeArgs($object, $parameters);
    }
}
