<?php

namespace App\Helper\Scripts\Loaders;

use App\Helper\Scripts\Loader;

abstract class AbstractLoader implements Loader
{

    /**
     * @inheritdoc
     */
    final public function get($script)
    {
        if (!$this->know($script)) {
            return null;
        }

        return $this->find($script);
    }

    /**
     * @param string $script
     *
     * @return array
     */
    abstract protected function find($script);
}