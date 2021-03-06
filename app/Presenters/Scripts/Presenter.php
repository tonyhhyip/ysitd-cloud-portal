<?php

namespace App\Presenters\Scripts;

interface Presenter
{
    /**
     * @param array|string $scripts
     *
     * @return string
     */
    public function provide($scripts);

    /**
     * Add Loaders for Presenter
     *
     * @param Loader|array $loaders
     *
     * @return void
     */
    public function addLoaders(array $loaders = []);

    /**
     * @param Loader $loader
     * @param bool $prepend
     *
     * @return mixed
     */
    public function addLoader(Loader $loader, $prepend = false);
}