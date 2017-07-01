<?php

use App\Models\VRLanguageCodes;
use App\Models\VRMenu;
use App\Models\VRPages;
use Illuminate\Support\Facades\Schema;

function getActiveLanguages()
{
    if (is_null(Schema::hasTable('vr_language_codes'))) {
        return "DB is empty";
    } else {
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
}

function getFrontEndMenu()
{
    if (is_null(Schema::hasTable('vr_menu'))) {
        return "DB is empty";
    } else {
        $data = VRMenu::where('vr_parent_id', null)->with('children')->orderBy('sequence', 'desc')->get()->toArray();
        return $data;
    }
}

function getRooms()
{
    if (is_null(Schema::hasTable('vr_categories_translations'))) {
        return "DB is empty";
    } else {
        $rooms = VRPages::where('category_id', '=', 'vr_rooms')->get()->toArray();

        return $rooms;
    }
}