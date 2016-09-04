<?php

namespace App\Helper\Scripts\Loaders;

use App\Helper\Scripts\Loader;
use Illuminate\Cache\Repository;

class CacheLoader extends AbstractLoader
{
    /**
     * @var Repository
     */
    private $cache;

    /**
     * @var Loader
     */
    private $loader;

    /**
     * CacheLoader constructor.
     *
     * @param Repository $cache
     * @param Loader $loader
     */
    public function __construct(Repository $cache, Loader $loader)
    {
        $this->cache = $cache;
        $this->loader = $loader;
    }

    /**
     * @inheritdoc
     */
    public function know($script)
    {
        if ($this->cache->has($script))
            return true;

        return $this->loader->has($script);
    }

    /**
     * @inheritdoc
     */
    public function find($script)
    {
        if (!$this->cache->has($script)) {
            return $this->loader->find($script);
        }

        return $this->cache->get($script);
    }
}