<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VRCategories extends Model
{
    /**
     * Table name
     * @var string
     */
    protected $table = 'vr_categories';

    /**
     * Fields which will be manipulated
     * @var array
     */
    protected $fillable = ['id'];
}
