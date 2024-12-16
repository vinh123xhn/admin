<?php

use App\Models\KeyWord;
use Illuminate\Support\Facades\Cache;

if (!function_exists('overrideTrackingUrl')) {
    function overrideTrackingUrl($url, $parameters = []): string
    {
        if (empty($parameters)) {
            $parameters = request()->session()->get('hkgh-tracking', []);
        }

        $queryString = http_build_query($parameters);

        if (empty($queryString)) {
            return $url;
        }

        return $url . (str_contains($url, '?') ? '&' : '?') . $queryString;
    }
}

if (!function_exists('keywords')) {
    function keywords(): string
    {
        return Cache::rememberForever('keywords', function () {
            return KeyWord::query()
                ->get()
                ->implode('keyword', ', ');
        });
    }
}