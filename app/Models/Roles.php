<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    use HasFactory;

    protected $table = 'roles';
    protected $primaryKey = 'id';

    protected $fillable = [
        'name', 'caption', 'is_admin',
    ];

    static $admin = 'admin';
    static $user = 'user';

    public function users()
    {
        return $this->hasMany('App\Models\User', 'role_id', 'id');
    }

    public function canDelete()
    {
        switch ($this->name) {
            case self::$admin:
            case self::$user:
                return false;
                break;
            default:
                return true;
        }
    }

    public function isDefaultRole()
    {
        return in_array($this->name, [self::$admin, self::$user]);
    }
}
