<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VRLanguageCodes extends CoreModel
{
    /**
     * Table name
     * @var string
     */
    protected $table = 'vr_language_codes';

    /**
     * Fields which will be manipulated
     * @var array
     */
    protected $fillable = ['id','language_code'];
}
