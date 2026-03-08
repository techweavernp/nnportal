<?php

namespace App\Helpers;

use Carbon\Carbon;
use DateTimeInterface;
use Exception;

class NepaliDateConvertor
{
    private const array NEPALI_MONTHS = [
        1 => 'वैशाख', 2 => 'जेठ', 3 => 'असार', 4 => 'श्रावण',
        5 => 'भदौ', 6 => 'असोज', 7 => 'कात्तिक', 8 => 'मंसिर',
        9 => 'पौष', 10 => 'माघ', 11 => 'फागुन', 12 => 'चैत्र'
    ];

    private const array WEEKDAYS = [
        0 => 'आइतबार', 1 => 'सोमबार', 2 => 'मङ्गलबार', 3 => 'बुधबार',
        4 => 'बिहीबार', 5 => 'शुक्रबार', 6 => 'शनिबार'
    ];

    private const array NEPALI_DIGITS = ['०', '१', '२', '३', '४', '५', '६', '७', '८', '९'];

    /**
     * Data: Days in each Nepali month for years 2070-2090 BS
     */
    private const array CALENDAR_DATA = [
        2082 => [31, 31, 32, 31, 31, 31, 30, 29, 30, 29, 30, 30],
        2083 => [31, 32, 31, 32, 31, 30, 30, 29, 30, 29, 30, 30],
        2084 => [31, 31, 31, 32, 31, 31, 29, 30, 29, 30, 29, 31],
        2085 => [31, 31, 31, 32, 31, 31, 30, 29, 29, 30, 29, 31],
        2086 => [31, 31, 32, 31, 31, 31, 30, 29, 30, 29, 30, 30],
        2087 => [31, 32, 31, 32, 31, 30, 30, 29, 30, 29, 30, 30],
        2088 => [31, 31, 31, 32, 31, 31, 29, 30, 29, 30, 29, 31],
        2089 => [31, 31, 31, 32, 31, 31, 30, 29, 29, 30, 29, 31],
        2090 => [31, 31, 32, 31, 31, 31, 30, 29, 30, 29, 30, 30],
    ];

    /**
     * Reference Point: 2026-03-15 (AD) = 2082-12-01 (BS)
     */
    private const int REF_AD_YEAR = 2026;
    private const int REF_AD_MONTH = 3;
    private const int REF_AD_DAY = 15;
    private const int REF_BS_YEAR = 2082;
    private const int REF_BS_MONTH = 12;
    private const int REF_BS_DAY = 1;

    /**
     * Formats a date to Nepali Human Readable format.
     */
    public static function toHuman(DateTimeInterface|string|null $date): string
    {
        if (!$date) return '';

        $carbonDate = Carbon::parse($date);
        $now = now();

        // If it's within the last 24 hours, return relative time
        if ($carbonDate->greaterThan($now->copy()->subDay())) {
            return self::toRelative($carbonDate);
        }

        return self::toFullDate($carbonDate);
    }

    /**
     * Formats a date into a full Nepali date string: "२०८२ फागुन १६, शनिबार".
     */
    public static function toFullDate(DateTimeInterface $date): string
    {
        try {
            $bs = self::convertGregorianToBs(
                (int)$date->format('Y'),
                (int)$date->format('m'),
                (int)$date->format('d')
            );

            $year = self::toNepaliDigits($bs['year']);
            $month = self::NEPALI_MONTHS[$bs['month']];
            $day = self::toNepaliDigits($bs['day']);
            $weekday = self::WEEKDAYS[(int)$date->format('w')];

            return "{$year} {$month} {$day}, {$weekday}";
        } catch (Exception $e) {
            return self::toNepaliDigits($date->format('Y-m-d'));
        }
    }

    /**
     * Formats relative time in Nepali: "५ मिनेट अघि".
     */
    public static function toRelative(DateTimeInterface $date): string
    {
        $diffInMinutes = now()->diffInMinutes($date, false);

        if ($diffInMinutes >= -60) {
            $value = abs($diffInMinutes);
            $unit = 'मिनेट';
        } elseif ($diffInMinutes >= -1440) {
            $value = abs((int) floor($diffInMinutes / 60));
            $unit = 'घण्टा';
        } else {
            return self::toFullDate($date);
        }

        return self::toNepaliDigits($value) . " {$unit} अघि";
    }

    /**
     * Converts Gregorian (AD) to Bikram Sambat (BS).
     */
    public static function convertGregorianToBs(int $gy, int $gm, int $gd): array
    {
        $currentDate = new \DateTime(sprintf("%04d-%02d-%02d", $gy, $gm, $gd));
        $referenceDate = new \DateTime(sprintf("%04d-%02d-%02d", self::REF_AD_YEAR, self::REF_AD_MONTH, self::REF_AD_DAY));

        $interval = $referenceDate->diff($currentDate);
        $totalDays = (int)$interval->format('%r%a');

        $ny = self::REF_BS_YEAR;
        $nm = self::REF_BS_MONTH;
        $nd = self::REF_BS_DAY;

        if ($totalDays >= 0) {
            while ($totalDays > 0) {
                $daysInMonth = self::CALENDAR_DATA[$ny][$nm - 1] ?? 30;
                $remainingInMonth = $daysInMonth - $nd + 1;

                if ($totalDays >= $remainingInMonth) {
                    $totalDays -= $remainingInMonth;
                    $nm++;
                    $nd = 1;
                    if ($nm > 12) {
                        $nm = 1;
                        $ny++;
                    }
                } else {
                    $nd += $totalDays;
                    $totalDays = 0;
                }
            }
        } else {
            $totalDays = abs($totalDays);
            while ($totalDays > 0) {
                if ($nd > $totalDays) {
                    $nd -= $totalDays;
                    $totalDays = 0;
                } else {
                    $totalDays -= $nd;
                    $nm--;
                    if ($nm < 1) {
                        $nm = 12;
                        $ny--;
                    }
                    $nd = self::CALENDAR_DATA[$ny][$nm - 1] ?? 30;
                }
            }
        }

        return ['year' => $ny, 'month' => $nm, 'day' => $nd];
    }

    /**
     * Converts English digits to Nepali digits.
     */
    public static function toNepaliDigits(string|int $number): string
    {
        $en = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
        return str_replace($en, self::NEPALI_DIGITS, (string) $number);
    }
}
