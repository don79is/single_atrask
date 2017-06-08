<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VRPermissions extends CoreModel
{
    /**
     * Table name
     * @var string
     */
    protected $table = 'vr_permissions';

    /**
     * Fields which will be manipulated
     * @var array
     */
    protected $fillable = ['id','name','comment'];
}
