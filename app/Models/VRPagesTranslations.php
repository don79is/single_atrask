<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VRPagesTranslations extends CoreModel
{
    /**
     * Table name
     * @var string
     */
    protected $table = 'vr_pages_translations';

    /**
     * Fields which will be manipulated
     * @var array
     */
    protected $fillable = ['id','page_id','language_code','title','description_short','	description_long','slug'];
}
