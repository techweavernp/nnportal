<?php

namespace App\Services;

use App\Models\AdCampaign;
use Cache;

class AdvertisementService
{
    public function getAllAds()
    {
        return Cache::remember('all_active_banners', 3600, function () {
            return AdCampaign::with('adList')
                ->whereHas('adList', function ($query) {
                    $query->whereIn('title', ['3D', 'Banner News Detail', 'Sidebar AL', 'Sidebar BL', 'Banner Header', 'Banner Footer']);
                })
                ->active()
                ->orderBy('display_order')
                ->get()
                ->groupBy('adList.title');
        });
    }
}
