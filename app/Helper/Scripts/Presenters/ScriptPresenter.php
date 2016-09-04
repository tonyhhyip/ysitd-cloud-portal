<?php

namespace App\Helper\Scripts\Presenters;


class ScriptPresenter extends AbstractPresenter
{
    protected function renderScript($script)
    {
        return sprintf('<script src="%s"></script>', $script);
    }
}