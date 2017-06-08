<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VRRoles extends CoreModel
{
    /**
     * Table name
     * @var string
     */
    protected $table = 'vr_roles';

    /**
     * Fields which will be manipulated
     * @var array
     */
    protected $fillable = ['id','name','comment'];
}
