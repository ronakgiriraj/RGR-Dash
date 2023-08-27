<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sections extends Model
{
    use HasFactory;

    protected $table = 'sections';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = ['name', 'caption', 'group_id'];

    public static $corePermission = 'admin';

    public function canDelete()
    {
        switch ($this->name) {
            case self::$corePermission:
                return false;
                break;
            default:
                return true;
        }
    }

    public function children() {
        return $this->hasMany($this, 'group_id', 'id');
    }
}
