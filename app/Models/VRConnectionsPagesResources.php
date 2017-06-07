<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VRConnectionsPagesResources extends Model
{
    /**
     * Table name
     * @var string
     */
    protected $table = 'vr_connections_pages_resources';

    /**
     * Fields which will be manipulated
     * @var array
     */
    protected $fillable = ['resource_id', 'page_id'];
}
