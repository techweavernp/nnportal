<?php

namespace App\Http\Controllers;

use App\Models\ElectionResult;
use App\Models\FrontPage\About;
use App\Models\FrontPage\Contact;
use App\Models\Post;
use App\Services\CategoryService;
use App\Services\PostService;
use Illuminate\View\View;

class FrontPageController extends Controller
{
    public function index(): View
    {
        // Menu categories
        $menuCategories = CategoryService::getMenus();

        // Election results
        //$electionResults = ElectionResult::orderByDesc('seats_won')->orderBy('id')->limit(5)->get();

        $postQuery = fn (?string $categorySlug = null) => PostService::postQuery($categorySlug);

        // Fetch data
        $bannerPosts     = $postQuery('banner')->limit(5)->get();
        $mainNews        = $postQuery('main-news')->limit(4)->get();

        // मुख्य समाचार...
        $featuredPost    = $mainNews->first();
        $mainNewsLists    = $mainNews->skip(1)->values();

        //भर्खरे...
        $latestPosts     = $postQuery()->limit(8)->get(); // no category filter

        return view('pages.index', compact(
            'menuCategories', 'bannerPosts', 'featuredPost',
            'mainNewsLists', 'latestPosts'
        ));
    }

    public function about(): View
    {
        $data['about'] = About::find(1);
        return view('pages.about', $data);
    }

    public function contact(): View
    {
        $data['contact'] = Contact::find(1);
        return view('pages.contact', $data);
    }
}
