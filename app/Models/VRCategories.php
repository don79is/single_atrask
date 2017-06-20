<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VRCategories extends CoreModel
{
    /**
     * Table name
     * @var string
     */
    protected $table = 'vr_categories';

    /**
     * Fields which will be manipulated
     * @var array
     */
    protected $fillable = ['id'];

    protected $with = ['translation'];

    public function translation ()
    {
        return $this->hasOne(VRCategoriesTranslations::class, 'record_id' , 'id')
            ->where('language_code', app()->getLocale());
    }
}
