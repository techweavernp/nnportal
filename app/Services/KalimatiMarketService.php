<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class KalimatiMarketService
{
    protected $url = 'https://kalimatimarket.gov.np/';

    /**
     * Fetch and parse market prices
     */
    public function getPrices()
    {
        // Cache for 6 hours since prices don't change frequently
        return Cache::remember('kalimati_prices', 21600, function () {
            try {
                $response = Http::withHeaders([
                    'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36'
                ])->get($this->url);

                if (!$response->successful()) {
                    return $this->getFallbackData();
                }

                return $this->parseHtml($response->body());
            } catch (\Exception $e) {
                //\Log::error('Kalimati scraping failed: ' . $e->getMessage());
                return $this->getFallbackData();
            }
        });
    }

    /**
     * Parse HTML and extract table data
     */
    protected function parseHtml($html): array
    {
        $dom = new \DOMDocument();
        libxml_use_internal_errors(true);
        $dom->loadHTML(mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8'));
        libxml_clear_errors();

        $xpath = new \DOMXPath($dom);

        // Find the commodity price table
        $table = $xpath->query("//table[@id='commodityDailyPrice']")->item(0);

        if (!$table) {
            return $this->getFallbackData();
        }

        $rows = $xpath->query(".//tbody/tr", $table);
        $prices = [];

        foreach ($rows as $row) {
            $cells = $xpath->query(".//td", $row);

            if ($cells->length >= 4) {
                // Get product name (remove the span text)
                $productCell = $cells->item(0);
                $productName = trim($productCell->nodeValue);

                // Clean up product name (remove extra spaces and unit)
                $productName = preg_replace('/\s+\([^)]+\)$/', '', $productName);
                $productName = trim($productName);

                // Get price values
                $minPrice = $this->extractNumber($cells->item(1)->nodeValue);
                $maxPrice = $this->extractNumber($cells->item(2)->nodeValue);
                $avgPrice = $this->extractNumber($cells->item(3)->nodeValue);

                $prices[] = [
                    'product' => $productName,
                    'min' => $minPrice,
                    'max' => $maxPrice,
                    'avg' => $avgPrice,
                    'unit' => $this->extractUnit($productCell),
                    'original' => trim($productCell->nodeValue)
                ];
            }
        }

        // Get current date in Nepali format
        $dateElement = $xpath->query("//div[contains(@class, 'features-inner') and contains(@class, 'even') and contains(@class, 'bg-white')]/h5");
        $nepaliDate = '';
        if ($dateElement->length > 0) {
            $fullText = trim($dateElement->item(0)->nodeValue);
            // Remove the prefix "संकलित दैनिक मूल्यहरु - " to get just the date
            $nepaliDate = str_replace('संकलित दैनिक मूल्यहरु - ', '', $fullText);
            $nepaliDate = trim($nepaliDate);
        }

        if (empty($nepaliDate)) {
            $nepaliDate = $this->getFallbackNepaliDate();
        }

        return [
            'date' => $nepaliDate,
            'prices' => $prices,
            'last_updated' => now()
        ];
    }

    /**
     * Extract numeric price from string (e.g., "रू ७०" -> 70)
     */
    protected function extractNumber($text): array|string
    {
        // Remove 'रू' and convert Nepali numbers to English
        $text = preg_replace('/[रू\s]/u', '', $text);

        $nepaliNumbers = ['०', '१', '२', '३', '४', '५', '६', '७', '८', '९'];
        $englishNumbers = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];

        return str_replace($nepaliNumbers, $englishNumbers, $text);
    }

    /**
     * Extract unit from product cell
     */
    protected function extractUnit($cell): string
    {
        $span = $cell->getElementsByTagName('span')->item(0);
        if ($span) {
            return trim($span->nodeValue, '() ');
        }
        return 'केजी';
    }

    /**
     * Get current date in Nepali format
     */
    protected function getNepaliDate(): string
    {
        $engDate = now();

        // You can use a package like 'nepali-calendar' for accurate conversion
        // For now, using a simple format
        $nepaliMonths = [
            'बैशाख', 'जेठ', 'असार', 'श्रावण', 'भदौ', 'आश्विन',
            'कार्तिक', 'मंसिर', 'पुष', 'माघ', 'फाल्गुन', 'चैत्र'
        ];

        $nepaliWeekdays = [
            'आइतबार', 'सोमबार', 'मङ्गलबार', 'बुधबार', 'बिहीबार', 'शुक्रबार', 'शनिबार'
        ];

        // This is approximate - use a proper conversion for production
        $month = $nepaliMonths[now()->month - 1];
        $day = now()->day;
        $weekday = $nepaliWeekdays[now()->dayOfWeek];
        $year = now()->year + 57; // Approximate Nepali year

        return "{$year} {$month} {$day}, {$weekday}";
    }

    /**
     * Fallback data in case scraping fails
     */
    protected function getFallbackData(): array
    {
        return [
            'date' => $this->getNepaliDate(),
            'prices' => [
                ['product' => 'गोलभेडा ठूलो', 'avg' => 00],
                ['product' => 'आलु रातो', 'avg' => 00],
                ['product' => 'प्याज सुकेको', 'avg' => 00],
                ['product' => 'काउली', 'avg' => 00],
                ['product' => 'बन्दा', 'avg' => 00],
            ],
            'last_updated' => now(),
            'is_fallback' => true
        ];
    }

    /**
     * Get only first 10 items for display
     */
    public function getLimitedPrices($limit = 100)
    {
        $data = $this->getPrices();
        $data['prices'] = array_slice($data['prices'], 0, $limit);
        return $data;
    }

    protected function getFallbackNepaliDate(): string
    {
        // You can keep this as a fallback or return a default message
        return "उपलब्ध छैन";
    }
}
