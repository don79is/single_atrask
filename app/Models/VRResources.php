<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VRResources extends CoreModel
{
    /**
     * Table name
     * @var string
     */
    protected $table = 'vr_resources';

    /**
     * Fields which will be manipulated
     * @var array
     */
    protected $fillable = ['id','mime_type','path','width','size','height'];
}
