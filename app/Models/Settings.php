<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    use HasFactory;

    protected $table = 'settings';
    protected $primaryKey = 'id';

    protected $fillable = ['name', 'page', 'value'];

    static function generalSetting(){
        return self::where('name', 'general')->first();
    }

    static function coreSetting(){
        return self::where('name', 'core')->first();
    }
}
