<?php

namespace jithin\CubetWpm\Facades;

use Illuminate\Support\Facades\Facade;

class WebPage extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'jithin\CubetWpm\WebPages';
    }
}
