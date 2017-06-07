<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VRMenuTranslations extends Model
{
    /**
     * Table name
     * @var string
     */
    protected $table = 'vr_menu_translations';

    /**
     * Fields which will be manipulated
     * @var array
     */
    protected $fillable = ['id','url','name','menu_id','language_code'];
}
