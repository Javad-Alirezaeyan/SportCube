<?php

namespace App\Http\Cache;


use Illuminate\Support\Facades\Cache;

class CacheMatches
{
    const MATCHES_KEY = 'matches';
    public static function getMatches()
    {
        if (!Cache::has(self::MATCHES_KEY)) {
            return null;
        }
        return Cache::get(self::MATCHES_KEY);
    }

    public static function setMatches($matches)
    {
        Cache::put(self::MATCHES_KEY, $matches);
    }



}