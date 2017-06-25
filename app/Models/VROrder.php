<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VROrder extends CoreModel
{
    /**
     * Table name
     * @var string
     */
    protected $table = 'vr_order';

    /**
     * Fields which will be manipulated
     * @var array
     */
    protected $fillable = ['id','status','user_id'];


}
