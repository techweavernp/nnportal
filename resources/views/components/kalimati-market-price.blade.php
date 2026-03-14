<?php
$service = new \App\Services\KalimatiMarketService();
$marketData = $service->getPrices();
?>


<section class="market-section reveal">
    <div class="section-header" style="margin-bottom: -5px;">
        <h2 class="section-title">कालिमाटी तरकारी मूल्य</h2>
        <div class="section-line"></div>
    </div>
    <div class="market-date-header">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
            <line x1="16" y1="2" x2="16" y2="6"></line>
            <line x1="8" y1="2" x2="8" y2="6"></line>
            <line x1="3" y1="10" x2="21" y2="10"></line>
        </svg>
        मिति: <span id="market-date-val">{{ $marketData['date'] }}</span>
    </div>

    <div class="market-table-container">
        <table class="market-table">
            <thead>
            <tr>
                <th>कृषि उपज</th>
                <th>औसत</th>
            </tr>
            </thead>
            <tbody>
            @forelse($marketData['prices'] as $item)
                <tr>
                    <td class="product-name">{{ $item['product'] }}</td>
                    <td class="price-avg">रू {{ number_format($item['avg'], 2) }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="2" class="text-center">मूल्य उपलब्ध छैन</td>
                </tr>
            @endforelse
            {{--<tr>
                <td class="product-name">गोलभेडा ठूलो (नेपाली)</td>
                <td class="price-avg">रू ६५.००</td>
            </tr>--}}
            </tbody>
        </table>
    </div>
</section>
