<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VRCategoriesTranslations extends CoreModel
{
    /**
     * Table name
     * @var string
     */
    protected $table = 'vr_categories_translations';

    /**
     * Fields which will be manipulated
     * @var array
     */
    protected $fillable = ['id', 'language_code', 'name', 'record_id'];
}
