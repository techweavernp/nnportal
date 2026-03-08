<?php

namespace App\Services;

use App\Models\Category;
use Illuminate\Support\Facades\Cache;

class CategoryService
{
    public static function getMenus()
    {
        return Cache::rememberForever('menu', function () {
            return Category::select('id', 'name', 'slug')
                ->isActive()
                ->showMenu()
                ->orderBy('display_order')
                ->get();
        });

    }
}
