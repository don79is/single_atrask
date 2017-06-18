<?php

use App\Models\VRLanguageCodes;

function getActiveLanguages()
{
    $languages = VRLanguageCodes::all()->where('is_active', '=', '1')->pluck('name', 'id')->toArray();
    $locale = app()->getLocale();

    if (!isset($languages[$locale])) {
        $locale = config('app.fallback_locale');

        if (!isset($languages[$locale])) {
            return $languages;
        }
    }
    $languages = [$locale => $languages[$locale]] + $languages;

    return $languages;

}