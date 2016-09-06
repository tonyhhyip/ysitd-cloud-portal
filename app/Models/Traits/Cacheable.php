<?php

namespace App\Models\Traits;

use Illuminate\Contracts\Cache\Repository;

trait Cacheable
{
    /**
     * @var Repository
     */
    protected $cache = null;

    /**
     * @var string
     */
    protected $cacheKey;

    /**
     * @return string
     */
    protected function getCacheKey()
    {
        return $this->cacheKey . $this->id;
    }

    /**
     * @return void
     */
    private function initCache()
    {
        if (!$this->cache)
            $this->cache = app(Repository::class);
    }

    public function forgetCached()
    {
        $this->initCache();
        $this->cache->forget($this->getCacheKey());
    }


    public static function bootCacheable()
    {
        static::created(function ($model) {
            $model->forgetCached();
        });
        static::updated(function ($model) {
            $model->forgetCached();
        });
        static::deleted(function ($model) {
            $model->forgetCached();
        });
    }

}