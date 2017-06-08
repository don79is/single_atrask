<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;
    public $incrementing = false;
    use SoftDeletes;
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

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function roles()
    {
        return $this->belongsToMany(VRRoles::class, 'vr_connections_users_roles', 'user_id', 'role_id' );
    }
}
