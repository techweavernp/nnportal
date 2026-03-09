<?php

use App\Models\AdCampaign;
use Illuminate\Support\Collection;
use Livewire\Component;

new class extends Component {
    public string $title;
    public string $position = 'main';
    public $banner = null;
    public Collection $banners;

    // Static property to cache banners across all instances
    protected static $singleBanners = null;
    protected static $multipleBanners = null;

    public function mount($title, $position='main'): void
    {
        $this->title = $title;
        $this->position = $position;
        $this->banners = collect();
        $this->loadBanner();
    }

    protected function loadBanner(): void
    {
        // Load banners only once for all instances
        if (self::$singleBanners === null) {
            $allBanners = AdCampaign::with('adList')
                ->whereHas('adList', function ($query) {
                    $query->whereIn('title', [
                        'Banner Header',
                        'Banner Inline',
                        'Banner Footer',
                        'Sidebar AL',
                        'Sidebar BL'
                    ]);
                })
                ->where('is_active', true)
                ->where('start_date', '<=', now())
                ->where(function ($query) {
                    $query->where('end_date', '>=', now())
                        ->orWhereNull('end_date');
                })
                ->orderBy('display_order')
                ->get();

            // For single banner positions (take first one)
            self::$singleBanners = $allBanners->keyBy(function ($item) {
                return $item->adList->title;
            });

            // For multiple banner positions (group by title)
            self::$multipleBanners = $allBanners->groupBy(function ($item) {
                return $item->adList->title;
            });
        }

        // Check if this is a multiple-banner position
        if (in_array($this->title, ['Sidebar AL', 'Sidebar BL'])) {
            $this->banners = self::$multipleBanners[$this->title] ?? collect();
            $this->banner = $this->banners->first(); // Keep for backward compatibility
        } else {
            // Single banner position
            $this->banner = self::$singleBanners[$this->title] ?? null;
        }
    }
};
?>

<div>
    @if($banner && $position == 'main')
        <div class="container">
            <div class="ad-space ad-top">
                <a href="{{ $banner->link_url }}" target="_blank">
                    <img src="{{ asset('storage/' . $banner->image) }}" alt="{{ $title }} Advertisement">
                </a>
            </div>
        </div>
    {{--@else
        <div class="container">
            <div class="ad-space ad-top" style="display: none;">
                --}}{{-- Hidden or empty div if you need to maintain space --}}{{--
            </div>
        </div>--}}
    @endif

    {{--@if($banner && $position == 'sidebar')
        @foreach($banner as $b)
            <div class="ad-space ad-sidebar">
                <a href="{{ $b->link_url }}" target="_blank">
                    <img src="{{ asset('storage/' . $b->image) }}" alt="{{ $title }} Advertisement">
                </a>
            </div>
        @endforeach
    @else
        <div class="ad-space ad-sidebar" style="display: none;">
            --}}{{-- Hidden or empty div if you need to maintain space --}}{{--
        </div>
    @endif--}}

    {{-- Sidebar positions (multiple banners) --}}
    @if($banners && $position == 'sidebar')
        @foreach($banners as $banner)
            <div class="ad-space ad-sidebar">
                <a href="{{ $banner->link_url }}" target="_blank">
                    <img src="{{ asset('storage/' . $banner->image) }}" alt="{{ $title }} Advertisement">
                </a>
            </div>
        @endforeach
    @endif
</div>
