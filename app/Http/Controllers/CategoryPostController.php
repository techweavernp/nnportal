<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Services\CategoryService;
use App\Services\PostService;
use Illuminate\View\View;

class CategoryPostController extends Controller
{
    public function index($slug)
    {
        // Menu categories
        $menuCategories = CategoryService::getMenus();

        $postQuery = fn (?string $categorySlug = null) => PostService::postQuery($categorySlug);

        $mainNews        = $postQuery($slug)->limit(10)->get();
        $featuredPost    = $mainNews->first();
        $newsLists       = $mainNews->skip(1)->values();
        $categoryName    = Category::select('id', 'name')->whereSlug($slug)->firstOrFail()->name;

        return view('pages.category', compact(
            'menuCategories', 'featuredPost', 'newsLists', 'categoryName'
        ));
    }

    public function show($slug)
    {
        // Menu categories
        $menuCategories = CategoryService::getMenus();

        $post = Post::with('author:id,name,nick_name')->whereSlug($slug)->first();

        // भर्खरे...
        $postQuery = fn (?string $categorySlug = null) => PostService::postQuery($categorySlug);
        $latestPosts     = $postQuery()->limit(4)->get();

        // ट्रेण्डिंग...
        $trendingPosts   = Post::with('author:id,name')
            ->published()
            ->orderByDesc('shares_count')
            ->orderByDesc('published_at')
            ->limit(6)
            ->get();

        return view('pages.post-detail', compact('menuCategories', 'post',
            'latestPosts', 'trendingPosts'
        ));
    }

}
