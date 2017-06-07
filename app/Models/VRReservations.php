<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VRReservations extends Model
{
    /**
     * Table name
     * @var string
     */
    protected $table = 'vr_reservations';

    /**
     * Fields which will be manipulated
     * @var array
     */
    protected $fillable = ['id','experience_id','order_id','time'];
}
