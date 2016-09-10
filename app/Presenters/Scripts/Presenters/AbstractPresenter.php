<?php

namespace App\Presenters\Scripts\Presenters;

use App\Presenters\Scripts\Presenter;
use App\Presenters\Scripts\Loader;

abstract class AbstractPresenter implements Presenter
{

    /**
     * @var array
     */
    protected $loaders = [];

    /**
     * @var array
     */
    protected $scripts = [];

    /**
     * @inheritdoc
     */
    public function addLoaders(array $loaders = [])
    {
        foreach ($loaders as $loader) {
            $this->addLoader($loader);
        }
    }

    /**
     * @inheritdoc
     */
    public function addLoader(Loader $loader, $prepend = false)
    {
       $prepend ? array_unshift($this->loaders, $loader) : array_push($this->loaders, $loader);
    }

    /**
     * @inheritdoc
     */
    final public function provide($scripts)
    {
        if (!is_array($scripts)) {
            $scripts = [$scripts];
        }
        $this->resolveRequired($scripts);
        return $this->render();
    }

    /**
     *
     * @return string
     */
    private function render()
    {
        $buffer = [];
        foreach ($this->scripts as $script) {
            $buffer[] = $this->renderScript($script);
        }

        return join($buffer);
    }

    abstract protected function renderScript($script);

    /**
     * @param array $scripts
     */
    private function resolveRequired(array $scripts)
    {
        $buffer = [];
        foreach ($scripts as $script) {
            $buffer = array_merge($buffer, $this->resolveScript($script));
        }
        $this->scripts = array_unique($buffer);
    }

    /**
     * @param string $script
     *
     * @return array
     */
    private function resolveScript($script)
    {
        foreach ($this->loaders as $loader) {
            if ($loader->know($script)) {
                return $loader->get($script);
            }
        }

        return [];
    }
}