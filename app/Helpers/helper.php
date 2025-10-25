<?php

use App\Models\Language;

function formatTags(array $tags)
{
    return implode(',', $tags);
}

//Side Bar Active
function setActive(array $routes)
{
    foreach ($routes as $route) {
        if (request()->routeIs($route)) {
            return 'active';
        }
    }

    return null;
}

// Get Language

function getLanguage()
{
    if (session()->has('language')) {
        return session('language');
    }

    try {
        $language = Language::where('is_default', 1)->first();
        $langCode = $language?->lang ?? 'en';
        setLanguage($langCode);
        return $langCode;
    } catch (\Throwable $th) {
        setLanguage('en');
        return 'en';
    }
}

function setLanguage(string $code): void
{
    session(['language' => $code]);
}

function truncate(string $text, int $limit = 100)
{
    return \Str::limit($text, $limit, '...');
}

if (!function_exists('convertToKFormat')) {
    function convertToKFormat(int $number): string
    {
        if ($number < 1000) {
            return (string) $number;
        } elseif ($number < 1000000) {
            return round($number / 1000, 1) . 'K';
        } else {
            return round($number / 1000000, 1) . 'M';
        }
    }
}
