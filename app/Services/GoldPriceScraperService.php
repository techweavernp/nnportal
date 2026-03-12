<?php

namespace App\Services;

use DOMDocument;
use DOMXPath;

class GoldPriceScraperService
{
    protected string $url = 'https://tisajwolan.com/gold';

    public function fetchPrices(): array
    {
        $html = file_get_contents($this->url);

        if (!$html) {
            throw new \Exception('Failed to fetch webpage');
        }

        $dom = new DOMDocument();
        @$dom->loadHTML($html);
        $xpath = new DOMXPath($dom);

        $prices = [];

        // Get date from first th
        $dateNode = $xpath->query('//table[@class="gold-silver-pricetable"]//tr[1]/th[1]')->item(0);
        $prices['date'] = $dateNode?->textContent ?? now()->format('Y/m/d');

        // Gold prices
        $goldRow = $xpath->query('//table[@class="gold-silver-pricetable"]//tr[@class="gld"]')->item(0);
        if ($goldRow) {
            $cells = $goldRow->getElementsByTagName('td');
            $prices['gold'] = [
                'tola' => $this->cleanNumber($cells[2]->textContent ?? ''),
                '10_gram' => $this->cleanNumber($cells[1]->textContent ?? ''),
            ];
        }

        // Silver prices
        $silverRow = $xpath->query('//table[@class="gold-silver-pricetable"]//tr[@class="slv"]')->item(0);
        if ($silverRow) {
            $cells = $silverRow->getElementsByTagName('td');
            $prices['silver'] = [
                'tola' => $this->cleanNumber($cells[2]->textContent ?? ''),
                '10_gram' => $this->cleanNumber($cells[1]->textContent ?? ''),
            ];
        }

        return $prices;
    }

    protected function cleanNumber(string $text): int
    {
        return (int) preg_replace('/[^\d]/', '', trim($text));
    }
}
