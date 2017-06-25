<?php

use App\Models\VRLanguageCodes;
use App\Models\VRMenu;
use App\Models\VRPages;

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

function getFrontEndMenu()
{

    $data = VRMenu::where('vr_parent_id', null)->with('children')->orderBy('sequence', 'desc')->get()->toArray();
    return $data;
}
function getRooms()
{
    $rooms = VRPages::where('category_id','=','vr_rooms')->get()->toArray();

    return $rooms;
}