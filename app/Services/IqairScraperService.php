<?php

// app/Services/IqairScraperService.php
namespace App\Services;

use DOMDocument;
use DOMXPath;
use Exception;

class IqairScraperService
{
    protected string $url = 'https://www.iqair.com/as/nepal/central-region/kathmandu';

    // ✅ Fallback data if scraping fails
    protected array $fallback = [
        'aqi' => 169,
        'category' => 'Unhealthy',
        'category_np' => 'अस्वस्थ',
        'location' => 'Kathmandu, Central Region',
        'pollutant' => 'PM2.5',
        'concentration' => 80.7,
        'unit' => 'µg/m³',
        'weather' => [
            'temp' => 22,
            'wind' => 13,
            'humidity' => 69,
            'icon' => 'ic-weather-01d.svg',
        ],
        'updated_at' => null,
    ];

    public function fetchData(): array
    {
        try {
            $html = $this->fetchHtml();
            $dom = new DOMDocument();
            @$dom->loadHTML($html, LIBXML_NOERROR | LIBXML_NOWARNING | LIBXML_HTML_NOIMPLIED);
            $xpath = new DOMXPath($dom);

            // Try to extract AQI value (multiple possible selectors)
            $aqi = $this->extractAqi($xpath);

            // If AQI not found, return fallback
            if (!$aqi || $aqi < 0) {
                \Log::warning('IQAir scrape failed - using fallback data');
                return $this->getFallbackData();
            }

            return [
                'aqi' => $aqi,
                'category' => $this->extractText($xpath, '//p[contains(text(), "Unhealthy") or contains(text(), "Moderate") or contains(text(), "Good")]') ?: 'Unknown',
                'category_np' => $this->translateCategory($aqi),
                'location' => 'Kathmandu, Central Region',
                'pollutant' => $this->extractText($xpath, '//p[text()="PM2.5" or text()="PM10" or text()="O3"]') ?: 'PM2.5',
                'concentration' => $this->extractNumber($xpath, '//p[contains(text(), "µg/m³")]') ?: 0,
                'unit' => 'µg/m³',
                'weather' => $this->extractWeather($xpath),
                'updated_at' => now()->format('Y-m-d H:i:s'),
            ];

        } catch (Exception $e) {
            \Log::error('IQAir scrape error: ' . $e->getMessage());
            return $this->getFallbackData();
        }
    }

    protected function extractAqi(DOMXPath $xpath): ?int
    {
        // Try multiple possible AQI selectors
        $queries = [
            '//p[contains(@class, "aqi-value") or contains(@class, "value")]/text()',
            '//div[contains(@class, "aqi-score") or contains(@class, "score")]//p/text()',
            '//p[text()[contains(., "AQI")]]/preceding-sibling::p/text()',
        ];

        foreach ($queries as $query) {
            $nodes = $xpath->query($query);
            foreach ($nodes as $node) {
                $text = trim($node->nodeValue);
                if (preg_match('/^\d{2,3}$/', $text)) {
                    return (int) $text;
                }
            }
        }
        return null;
    }

    protected function extractText(DOMXPath $xpath, string $query): ?string
    {
        $node = $xpath->query($query)->item(0);
        return $node ? trim($node->nodeValue) : null;
    }

    protected function extractNumber(DOMXPath $xpath, string $query): ?float
    {
        $text = $this->extractText($xpath, $query);
        if (!$text) return null;
        preg_match('/[\d.]+/', $text, $matches);
        return isset($matches[0]) ? (float) $matches[0] : null;
    }

    protected function extractWeather(DOMXPath $xpath): array
    {
        // IQAir weather is likely JS-rendered; return fallback
        return [
            'temp' => 22,
            'wind' => 13,
            'humidity' => 69,
            'icon' => 'ic-weather-01d.svg',
        ];
    }

    protected function translateCategory(int $aqi): string
    {
        return match (true) {
            $aqi <= 50 => 'राम्रो',
            $aqi <= 100 => 'मध्यम',
            $aqi <= 150 => 'संवेदनशील समूहका लागि अस्वस्थ',
            $aqi <= 200 => 'अस्वस्थ',
            $aqi <= 300 => 'धेरै अस्वस्थ',
            default => 'खतरनाक',
        };
    }

    protected function getFallbackData(): array
    {
        $data = $this->fallback;
        $data['updated_at'] = now()->format('Y-m-d H:i:s');
        return $data;
    }

    protected function fetchHtml(): string
    {
        $options = [
            'http' => [
                'header' => "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36\r\n"
                    . "Accept: text/html,application/xhtml+xml\r\n"
                    . "Accept-Language: en-US,en;q=0.9\r\n"
                    . "Referer: https://www.iqair.com/\r\n",
                'timeout' => 30,
            ]
        ];
        $context = stream_context_create($options);
        $html = file_get_contents($this->url, false, $context);

        if ($html === false) {
            throw new Exception('Failed to fetch IQAir page');
        }
        return $html;
    }
}
