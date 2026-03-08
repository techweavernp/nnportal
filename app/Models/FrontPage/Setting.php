<?php

namespace App\Models\FrontPage;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $guarded = ['id'];
    public $timestamps = false;

    protected $casts = [
        'meta_content' => 'json',
        'header_content' => 'json',
        'footer_content' => 'json',
        'hero_image' => 'json',
        'color_theme' => 'json',
        'why_choose_us' => 'json',
    ];
}
