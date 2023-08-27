<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Permission;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'username', 'email', 'mobile', 'password', 'bio', 'role_id', 'avatar',
    ];

    public static $active = 'active';
    public static $inactive = 'inactive';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function isAdmin(){
        return $this->role->is_admin;
    }

    public function role(){
        return $this->belongsTo('App\Models\Roles','role_id','id');
    }

    public function hasPermission($section_name)
    {
        if (self::isAdmin()) {
            if (!isset($this->permissions)) {
                $sections_id = Permission::where('role_id', $this->role_id)->where('allow', '1')->pluck('section_id')->toArray();
                $this->permissions = Sections::whereIn('id', $sections_id)->pluck('name')->toArray();
            }
            return in_array($section_name, $this->permissions);
        }
        return false;
    }
}
