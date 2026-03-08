<?php

namespace App\Http\Controllers;

use App\Models\FrontPage\About;
use App\Models\FrontPage\Contact;
use App\Services\CategoryService;
use App\Services\PostService;
use Illuminate\View\View;

class FrontPageController extends Controller
{
    public function index($slug=null)
    {
        if ($redirect = $this->handleLegacyRedirect($slug)) {
            return $redirect;
        }

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

        // Highlights
        $highlights      = $postQuery('highlights')->limit(4)->get();

        return view('pages.index', compact(
            'menuCategories', 'bannerPosts', 'featuredPost',
            'mainNewsLists', 'latestPosts', 'highlights'
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

    private function handleLegacyRedirect(string $slug=null)
    {
        if (!isset($slug)) return null;

        $redirects = config('redirects', []);
        if (isset($redirects[$slug])) {
            return redirect()->to('/post/' . $redirects[$slug], 301);
        }

        return null;
    }
}
