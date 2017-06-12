<?php

use App\Models\VRLanguageCodes;

function getActiveLanguages()
{
    return VRLanguageCodes::all()->where('is_active', '=', '1')->pluck('id', 'name');


}