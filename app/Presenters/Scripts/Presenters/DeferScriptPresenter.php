<?php

namespace App\Presenters\Scripts\Presenters;

class DeferScriptPresenter extends AbstractPresenter
{
    protected function renderScript($script)
    {
        return sprintf('<script defer src="%s"></script>', $script);
    }
}