<!-- Info & Utilities Section (Date, Rates, AQI) -->
<?php
$scraper = new \App\Services\GoldPriceScraperService();
$prices = $scraper->fetchPrices();

$scraperDate = new \App\Services\DateScraperService();
$calendar = $scraperDate->getTodayData();

$aqiService = new \App\Services\IqairScraperService();
$iqair = $aqiService->fetchData();

?>
<section class="info-utilities-section reveal">
    <div class="container">
        <div class="utilities-grid">
            <!-- Date Card -->
            {{--<div class="utility-card date-card">
                <div class="date-large">
                    <span id="nepali-date-num">२७</span>
                    <span id="nepali-baar">बुधबार</span>
                </div>
                <div class="card-content">
                    <div class="nepali-date-main" id="nepali-date-full">२०८२ फागुन</div>
                    <div class="date-details">
                        <span id="nepali-tithi">शुक्ल एकादशी</span>
                    </div>
                    <div class="event-text">
                        फागु पुर्णिमा (तराइ होली)/खण्डग्रास चन्द्र ग्रहण/विश्व वन्यजन्तु दिवस
                    </div>
                </div>
            </div>--}}
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

            <!-- Air Quality Card (IQAir) -->
            {{--<div class="utility-card iqair-wrapper">
                <div class="aqi-card-custom">
                    <div class="aqi-main-info aqi-bg-red">
                        <div class="aqi-header">
                            <div class="aqi-score-box">
                                <p class="aqi-value">१६९</p>
                                <span class="aqi-label">US AQI⁺</span>
                            </div>
                            <div class="aqi-status">
                                <p class="status-text">अस्वस्थ</p>
                                <div class="status-desc">Kathmandu Central Region</div>
                            </div>
                            <div class="aqi-face">
                                <img src="https://www.iqair.com/assets/svg/aqi/ic_face_48_red.svg" alt="Face">
                            </div>
                        </div>
                        <div class="aqi-separator"></div>
                        <div class="aqi-details">
                            <div class="pollutant">
                                <span class="p-label">प्रमुख प्रदूषक:</span>
                                <span class="p-value">PM2.5</span>
                            </div>
                            <div class="p-concentration">८०.७ µg/m³</div>
                        </div>
                    </div>
                    <div class="aqi-weather-bar">
                        <div class="w-item">
                            <img src="https://www.iqair.com/assets/svg/weather/ic-weather-01d.svg"
                                 alt="Weather">
                            <span>२२°</span>
                        </div>
                        <div class="w-item">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                 stroke-width="2">
                                <path
                                    d="M9.59 4.59A2 2 0 1 1 11 8H2m10.59 11.41A2 2 0 1 0 14 16H2m15.73-8.27A2.5 2 0 1 1 19.5 12H2">
                                </path>
                            </svg>
                            <span>१३ km/h</span>
                        </div>
                        <div class="w-item">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                 stroke-width="2">
                                <path d="M12 2.69l5.66 5.66a8 8 0 1 1-11.31 0z"></path>
                            </svg>
                            <span>६९ %</span>
                        </div>
                    </div>
                </div>
            </div>--}}
            <div class="utility-card iqair-wrapper">
                <div class="aqi-card-custom">
                    <div class="aqi-main-info {{ \App\Services\IqairScraperService::getAqiBgClass($iqair['aqi']) }}">
                        <div class="aqi-header">
                            <div class="aqi-score-box">
                                <p class="aqi-value">
                                    {{ App\Helpers\NepaliDateConvertor::toNepaliDigits($iqair['aqi']) }}
                                </p>
                                <span class="aqi-label">US AQI⁺</span>
                            </div>
                            <div class="aqi-status">
                                <p class="status-text">{{ $iqair['category_np'] }}</p>
                                <div class="status-desc">{{ $iqair['location'] }}</div>
                            </div>
                            <div class="aqi-face">
                                <img src="https://www.iqair.com/assets/svg/aqi/ic_face_48_{{ \App\Services\IqairScraperService::getAqiColor($iqair['aqi']) }}.svg" alt="Face">
                            </div>
                        </div>
                        <div class="aqi-separator"></div>
                        <div class="aqi-details">
                            <div class="pollutant">
                                <span class="p-label">प्रमुख प्रदूषक:</span>
                                <span class="p-value">{{ $iqair['pollutant'] }}</span>
                            </div>
                            <div class="p-concentration">
                                {{ App\Helpers\NepaliDateConvertor::toNepaliDigits(number_format($iqair['concentration'], 1)) }} {{ $iqair['unit'] }}
                            </div>
                        </div>
                    </div>

                    <div class="aqi-weather-bar">
                        <div class="w-item">
                            <img src="https://www.iqair.com/assets/svg/weather/{{ $iqair['weather']['icon'] }}" alt="Weather" width="24" height="24">
                            <span>{{ App\Helpers\NepaliDateConvertor::toNepaliDigits($iqair['weather']['temp']) }}°</span>
                        </div>
                        <div class="w-item">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M9.59 4.59A2 2 0 1 1 11 8H2m10.59 11.41A2 2 0 1 0 14 16H2m15.73-8.27A2.5 2.5 0 1 1 19.5 12H2"/>
                            </svg>
                            <span>{{ App\Helpers\NepaliDateConvertor::toNepaliDigits($iqair['weather']['wind']) }} km/h</span>
                        </div>
                        <div class="w-item">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M12 2.69l5.66 5.66a8 8 0 1 1-11.31 0z"/>
                            </svg>
                            <span>{{ App\Helpers\NepaliDateConvertor::toNepaliDigits($iqair['weather']['humidity']) }} %</span>
                        </div>
                    </div>
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
        </div>
    </div>
</section>
