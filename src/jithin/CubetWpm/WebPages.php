<?php

namespace jithin\CubetWpm;

use jithin\CubetWpm\Models\WebPage;

class WebPages
{
    /**
     * Bind page data to view and return.
     */
    public static function bind($wp_slug, $view = 'wpm/static')
    {
        $wp = WebPage::where([
            'wp_slug' => $wp_slug,
            'wp_status' => 'published',
        ])->firstOrFail();
        
        return view($view, compact('wp'));
    }
}
