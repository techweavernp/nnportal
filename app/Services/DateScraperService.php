<?php

namespace App\Services;

use DOMDocument;
use DOMXPath;
use Exception;

class DateScraperService
{
    protected string $url = 'https://www.hamropatro.com/';

    /**
     * Fetch Nepali calendar data from hamropatro.com
     * Returns array with date, tithi, panchang, events
     */
    public function getTodayData(): array
    {
        $html = $this->fetchHtml();

        $dom = new DOMDocument();
        // Suppress warnings for malformed HTML
        @$dom->loadHTML($html, LIBXML_NOERROR | LIBXML_NOWARNING | LIBXML_HTML_NOIMPLIED);

        $xpath = new DOMXPath($dom);

        // Extract main Nepali date line: "२७ फागुन २०८२, बुधवार"
        $fullDate = $this->extractByPattern($xpath, '/^०?[१-९]|[१०-३२]\s+[आइउएओकखगघङचछजझञटठडढणतथदधनपफबभमयरलवशषसह]+\s+२०[७-८][०-९],\s+[आइउएओकखगघङचछजझञटठडढणतथदधनपफबभमयरलवशषसह]+बार$/');

        // Fallback: try common header patterns
        if (empty($fullDate)) {
            $fullDate = $this->getText($xpath, '//h1[contains(text(), "२०") and contains(text(), "फागुन") or contains(text(), "चैत") or contains(text(), "वैशाख")]');
        }
        if (empty($fullDate)) {
            // Try finding by Nepali digit pattern near top of page
            $nodes = $xpath->query('//text()[contains(., "२०८") and contains(., "फागुन") or contains(., "चैत") or contains(., "वैशाख") or contains(., "जेठ") or contains(., "असार")]');
            foreach ($nodes as $node) {
                $text = trim($node->nodeValue);
                if (preg_match('/[०-९]+\s+[\p{Nepali}]+,\s*[\p{Nepali}]+बार?/u', $text)) {
                    $fullDate = $text;
                    break;
                }
            }
        }

        // Parse full date into components
        $parsed = $this->parseNepaliDate($fullDate);

        // Extract Tithi: "चैत कृष्ण अष्टमी"
        $tithi = $this->getText($xpath, '//text()[contains(., "कृष्ण") or contains(., "शुक्ल")][1]');
        if (empty($tithi) || mb_strlen($tithi) > 50) {
            // Fallback: look for line after date
            $tithi = $this->extractByContext($html, $fullDate, 1);
        }

        // Extract Panchang: "वज्र बालव ज्येष्ठा"
        $panchangLabel = $this->getText($xpath, '//text()[contains(., "पञ्चाङ्ग:")]');
        $panchang = '';
        if (!empty($panchangLabel)) {
            $panchang = trim(str_replace('पञ्चाङ्ग:', '', $panchangLabel));
        }
        if (empty($panchang)) {
            $panchang = $this->extractByContext($html, $tithi, 1);
        }

        // Extract Today's Event: "गोरखकाली पूजा"
        $event = $this->extractTodayEvent($xpath, $parsed['day_num'] ?? '');

        return [
            'full_date' => $fullDate ?: '—',
            'day_num' => $parsed['day_num'] ?? '',
            'month' => $parsed['month'] ?? '',
            'year' => $parsed['year'] ?? '',
            'day_name' => $parsed['day_name'] ?? '',
            'tithi' => $tithi ?: '—',
            'panchang' => $panchang ?: '—',
            'event' => $event ?: '—',
            'english_date' => date('F j, Y'),
            'fetched_at' => now()->format('Y-m-d H:i:s'),
        ];
    }

    /**
     * Fetch HTML with proper headers
     */
    protected function fetchHtml(): string
    {
        $options = [
            'http' => [
                'header' => "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36\r\n"
                    . "Accept: text/html,application/xhtml+xml\r\n"
                    . "Accept-Language: ne-NP,ne;q=0.9,en;q=0.8\r\n",
                'timeout' => 30,
                'ignore_errors' => true,
            ]
        ];
        $context = stream_context_create($options);
        $html = file_get_contents($this->url, false, $context);

        if ($html === false) {
            throw new Exception("Failed to fetch {$this->url}");
        }

        return $html;
    }

    /**
     * Safe text extraction
     */
    protected function getText(DOMXPath $xpath, string $query): string
    {
        $node = $xpath->query($query)->item(0);
        return $node ? trim($node->nodeValue) : '';
    }

    /**
     * Extract text by regex pattern across all text nodes
     */
    protected function extractByPattern(DOMXPath $xpath, string $pattern): string
    {
        $nodes = $xpath->query('//text()');
        foreach ($nodes as $node) {
            $text = trim($node->nodeValue);
            if (preg_match($pattern . 'u', $text)) {
                return $text;
            }
        }
        return '';
    }

    /**
     * Extract line by context (N lines after a marker)
     */
    protected function extractByContext(string $html, string $marker, int $linesAfter = 1): string
    {
        if (empty($marker)) return '';
        $lines = array_filter(array_map('trim', preg_split('/\r\n|\r|\n/', strip_tags($html))));
        $found = false;
        $count = 0;

        foreach ($lines as $line) {
            if ($found) {
                if ($count === $linesAfter && !empty($line) && mb_strlen($line) < 100) {
                    return $line;
                }
                $count++;
            }
            if (mb_strpos($line, $marker) !== false) {
                $found = true;
                $count = 0;
            }
        }
        return '';
    }

    /**
     * Parse Nepali date string into components
     * Input: "२७ फागुन २०८२, बुधवार"
     */
    protected function parseNepaliDate(string $date): array
    {
        $result = ['day_num' => '', 'month' => '', 'year' => '', 'day_name' => ''];

        // Remove commas and split
        $clean = str_replace(',', '', trim($date));
        $parts = preg_split('/\s+/', $clean);

        if (count($parts) >= 3) {
            $result['day_num'] = $parts[0]; // २७
            $result['month'] = $parts[1];   // फागुन
            $result['year'] = $parts[2];    // २०८२
        }
        if (count($parts) >= 4) {
            $result['day_name'] = str_replace('बार', '', $parts[3]); // बुध
        }

        return $result;
    }

    /**
     * Extract today's event by matching day number in calendar grid
     */
    protected function extractTodayEvent(DOMXPath $xpath, string $nepaliDayNum): string
    {
        if (empty($nepaliDayNum)) return '';

        // Try to find event associated with today's day number
        // Look for pattern: day number followed by event text
        $nodes = $xpath->query('//text()');
        $foundDay = false;

        foreach ($nodes as $node) {
            $text = trim($node->nodeValue);
            // If we find today's day number, next non-empty short text might be event
            if ($text === $nepaliDayNum) {
                $foundDay = true;
                continue;
            }
            if ($foundDay && !empty($text) && mb_strlen($text) < 80 && !preg_match('/^[०-९]+$/', $text)) {
                // Skip common non-event texts
                if (!preg_match('/^(VIEW DETAILS|ADD NOTE|Notes Loading|पञ्चाङ्ग)/', $text)) {
                    return $text;
                }
            }
        }

        // Fallback: extract from known event patterns
        $eventPatterns = [
            '/([^\n\/]+(?:पूजा|व्रत|दिवस|बिदा|जात्रा|संक्रान्ति)[^\n\/]*)/u',
            '/([^\n\/]+(?:होली|ग्रहण|निर्वाचन)[^\n\/]*)/u',
        ];

        foreach ($eventPatterns as $pattern) {
            if (preg_match($pattern, $this->fetchHtml(), $matches)) {
                return trim($matches[1]);
            }
        }

        return '';
    }

    /**
     * Convert English digits to Nepali (for display consistency)
     */
    public static function toNepaliDigits($number): string
    {
        return str_replace(
            range(0, 9),
            ['०','१','२','३','४','५','६','७','८','९'],
            (string)$number
        );
    }
}
