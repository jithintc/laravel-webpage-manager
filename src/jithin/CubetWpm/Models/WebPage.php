<?php

namespace jithin\CubetWpm\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WebPage extends Model
{
    use SoftDeletes;
    protected $table = 'web_pages';
    protected $fillable = ['wp_slug', 'wp_title', 'wp_content', 'wp_tags', 'wp_status'];
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];
}
