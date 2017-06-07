<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VRUsers extends Model
{
    /**
     * Table name
     * @var string
     */
    protected $table = 'vr_users';

    /**
     * Fields which will be manipulated
     * @var array
     */
    protected $fillable = ['id','name','email','password','	remember_token','phone'];
}
