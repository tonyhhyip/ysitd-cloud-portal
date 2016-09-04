<?php

namespace App\Helper\Scripts\Loaders;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Arr;

class JsonFileLoader extends AbstractLoader
{
    /**
     * @var \Illuminate\Contracts\Filesystem\Filesystem
     */
    private $file;

    /**
     * @var string
     */
    private $cachePath;

    /**
     * @var string
     */
    private $appPath;

    /**
     * @var bool
     */
    private $cacheLoaded = false;

    /**
     * @var bool
     */
    private $dataLoaded = false;

    /**
     * @var array
     */
    private $cache = [];

    /**
     * @var array
     */
    private $data = [];

    public function __construct(Filesystem $file)
    {
        $this->file = $file;
        $this->cachePath = storage_path('app/scripts.json');
        $this->appPath = resource_path('assets/js/scripts.json');
    }

    /**
     * @inheritdoc
     */
    protected function find($script)
    {
        $this->init();
        if (Arr::has($this->cache, $script)) {
            return $this->cache[$script];
        } else {
            if (!$this->dataLoaded) {
                $this->loadData();
            }

            $scripts = [];
            $todo = [$script];
            while (count($todo) !== 0) {
                $load = array_shift($todo);
                $data = $this->data[$load];
                $source = $data['src'];
                $source = is_array($source) ? $source : [$source];
                $scripts = array_merge($scripts, $source);

                if (isset($data['depends'])) {
                    $depends = $data['depends'];
                    $depends = is_array($depends) ? $depends : [$depends];
                    $todo = array_merge($todo, $depends);
                }
            }

            $scripts = $this->processArray($scripts);
            $this->saveToCache($script, $scripts);
            return $scripts;
        }
    }
    
    /**
     * @inheritdoc
     */
    public function know($script)
    {
        $this->init();
        if (Arr::has($this->cache, $script)) {
            return true;
        }

        if (!$this->dataLoaded) {
            $this->loadData();
        }
        return Arr::has($this->data, $script);
    }

    private function processArray(array $scripts)
    {
        return array_map(function ($url) {
            return $this->resolveUrl($url);
        }, array_unique(array_reverse($scripts)));
    }

    private function saveToCache($script, array $url)
    {
        $this->cache[$script] = $url;
        $this->file->put($this->cachePath, json_encode($this->cache));
    }

    /**
     * @return void
     */
    private function init()
    {
        if (!$this->isExpire() && !$this->cacheLoaded) {
            $this->loadCache();
        }
    }

    /**
     * @return void
     */
    private function loadCache()
    {
        $content = $this->file->get($this->cachePath);
        $this->cache = json_decode($content, true);
        $this->cacheLoaded = true;
    }

    /**
     * @return void
     */
    private function loadData()
    {
        $content = $this->file->get($this->appPath);
        $this->data = json_decode($content, true);
        $this->dataLoaded = true;
    }


    /**
     * @return bool
     */
    private function isExpire()
    {
        if (!$this->file->exists($this->cachePath)) {
            return true;
        }
        $cache = $this->file->lastModified($this->cachePath);
        $scripts = $this->file->lastModified($this->appPath);
        return $cache >= $scripts;
    }

    /**
     * @param string $path
     *
     * @return string
     */
    private function resolveUrl($path)
    {
        $regexp = '/(?<protocol>(?:[0-9]|[a-z])+)(?::\/\/)(?<library>(?:[0-9]|[a-z]|[\-])+)(?:(?::)(?<version>(?:[0-9]|[\.])+)(?:@)(?<file>(?:[0-9]|[a-z]|[\-\.])+))?/i';
        if (!preg_match($regexp, $path, $match)) {
            throw new \InvalidArgumentException("{$path} cannot be matched");
        }

        $method = 'get' . ucfirst($match['protocol']) . 'Url';
        if (!method_exists($this, $method)) {
            throw new \InvalidArgumentException('Protocol ' . $match['protocol'] . ' does not support');
        }

        $url = call_user_func([$this, $method], $match);
        return $url;
    }

    /**
     * @param array $data
     *
     * @return string
     */
    private function getCdnjsUrl(array $data)
    {
        return sprintf(
            "https://cdnjs.cloudflare.com/ajax/libs/%s/%s/%s.min.js",
            $data['library'],
            $data['version'],
            $data['file']
        );
    }

    /**
     * @param array $data
     *
     * @return string
     */
    private function getHostUrl(array $data)
    {
        return url(sprintf("js/%s.min.js", $data['library']));
    }
    
}