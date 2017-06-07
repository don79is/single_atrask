<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VRPages extends Model
{
    /**
     * Table name
     * @var string
     */
    protected $table = 'vr_pages';

    /**
     * Fields which will be manipulated
     * @var array
     */
    protected $fillable = ['id','category_id','cover_id'];
}
