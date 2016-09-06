<?php

namespace App\Models\Traits;

use Illuminate\Database\Eloquent\ModelNotFoundException;

trait FindByName
{
    public static function findByName($name)
    {
        $instance = static::where('name', $name)->first();
        if (!$instance) {
            throw new ModelNotFoundException();
        }

        return $instance;
    }
}