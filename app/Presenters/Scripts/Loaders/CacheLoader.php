<?php

namespace App\Presenters\Scripts\Loaders;

use App\Presenters\Scripts\Loader;
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
     * @var string
     */
    private $prefix = 'scripts:';

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

        return $this->loader->know($script);
    }

    /**
     * @inheritdoc
     */
    public function find($script)
    {
        if (!$this->cache->has($this->prefix . $script)) {
            $result = $this->loader->find($script);
            $this->cache->put($this->prefix.$script, $result);
            return $result;
        }

        return $this->cache->get($script);
    }
}