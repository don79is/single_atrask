<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VRConnectionsRolesPermissions extends Model
{
    /**
     * Table name
     * @var string
     */
    protected $table = 'vr_connections_roles_permissions';

    /**
     * Fields which will be manipulated
     * @var array
     */
    protected $fillable = ['role_id','permission_id'];
}
