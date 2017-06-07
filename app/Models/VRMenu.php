<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VRMenu extends Model
{
    /**
     * Table name
     * @var string
     */
    protected $table = 'vr_menu';

    /**
     * Fields which will be manipulated
     * @var array
     */
    protected $fillable = ['id','new_window','sequence','vr_parent_id'];
}
