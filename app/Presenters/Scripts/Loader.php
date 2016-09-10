<?php

namespace App\Presenters\Scripts;

interface Loader
{
    /**
     * Load the required link of script.
     *
     * @param string $script
     *
     * @return array|null
     */
    public function get($script);

    /**
     * Check if script record exists
     *
     * @param string $script
     *
     * @return bool
     */
    public function know($script);
}