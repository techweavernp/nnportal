<?php
$prices = (new \App\Services\GoldPriceScraperService())->fetchPrices();
$calendar = (new \App\Services\DateScraperService())->getTodayData();
?>
<link rel="stylesheet" href="{{asset('assets/css/date-gold-nepse.css')}}">
<section class="info-utilities-section reveal">
    <div class="container">
        <div class="utilities-grid">
            <!-- Date Card -->
            <div class="utility-card date-card">
                <div class="date-large">
                    <span id="nepali-date-num">{{ $calendar['day_num'] }}</span>
                    <span id="nepali-baar">{{ $calendar['day_name'] }}</span>
                </div>
                <div class="card-content">
                    <div class="nepali-date-main" id="nepali-date-full">
                        {{ $calendar['full_date'] }}
                    </div>
                    <div class="date-details">
                        <span id="nepali-tithi">{{ $calendar['tithi'] }}</span><br>
                        @if($calendar['panchang'] && $calendar['panchang'] !== '—')
                            <span class="panchang text-sm text-gray-500 block mt-1">
                    पञ्चाङ्ग: {{ $calendar['panchang'] }}
                </span>
                        @endif
                    </div>
                    @if($calendar['event'] && $calendar['event'] !== '—')
                        <div class="event-text text-sm mt-2 p-2 bg-amber-50 rounded border border-amber-200">
                            {{ $calendar['event'] }}
                        </div>
                    @endif
                </div>
            </div>

            <!-- Gold & Silver Card -->
            <div class="utility-card rates-card">
                <div class="rates-as-of" id="rates-as-of">
                    मिति: {{\App\Helpers\NepaliDateConvertor::toNepaliDigits($prices['date'])}}</div>
                <table class="rates-table">
                    <thead>
                    <tr>
                        <th></th>
                        <th>वस्तु</th>
                        <th>प्रति तोला</th>
                        <th>प्रति १० ग्राम</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td class="rate-icon-cell">
                            <div class="bar-icon gold-bar"></div>
                        </td>
                        <td>सुन (छापावाल)</td>
                        <td class="rate-val-cell">
                            रु {{\App\Helpers\NepaliDateConvertor::toNepaliDigits($prices['gold']['tola'])}}</td>
                        <td class="rate-val-cell">
                            रु {{\App\Helpers\NepaliDateConvertor::toNepaliDigits($prices['gold']['10_gram'])}}</td>
                    </tr>
                    <tr>
                        <td class="rate-icon-cell">
                            <div class="bar-icon silver-bar"></div>
                        </td>
                        <td>चाँदी</td>
                        <td class="rate-val-cell">
                            रु {{\App\Helpers\NepaliDateConvertor::toNepaliDigits($prices['silver']['tola'])}}</td>
                        <td class="rate-val-cell">
                            रु {{\App\Helpers\NepaliDateConvertor::toNepaliDigits($prices['silver']['10_gram'])}}</td>
                    </tr>
                    </tbody>
                </table>
            </div>

            <!-- NEPSE Today Card -->
            <div class="utility-card nepse-card">
                <div class="nepse-header">
                    <span class="nepse-title">नेप्से (NEPSE)</span>
                    <span class="nepse-status-badge status-open">Open</span>
                </div>
                <div class="nepse-main">
                    <div class="nepse-value-box">
                        <h3 class="nepse-index">२८२४.९०</h3>
                        <div class="nepse-change up">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                 stroke-width="3">
                                <polyline points="18 15 12 9 6 15"></polyline>
                            </svg>
                            <span>४.४५ (०.१५%)</span>
                        </div>
                    </div>
                    <div class="nepse-meta">
                        <div class="meta-item">
                            <span class="label">कारोबार:</span>
                            <span class="value">१४.३२ अर्ब</span>
                        </div>
                        <div class="meta-item">
                            <span class="label">मिति:</span>
                            <span class="value">२०२६/०३/१५</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
