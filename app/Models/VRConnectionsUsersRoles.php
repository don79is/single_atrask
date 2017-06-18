<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VRConnectionsUsersRoles extends Model
{
    /**
     * Table name
     * @var string
     */
    protected $table = 'vr_connections_users_roles';

    /**
     * Fields which will be manipulated
     * @var array
     */
    protected $fillable = ['user_id','role_id'];

    public $updated_at = false;
}
