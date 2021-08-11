<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;
    protected $fillable = [
        'name','display_name'
    ];
    public function permissionsChildren()
    {
        return $this->hasMany(Permission::class,'parent_id');
    }
    public static function search($search){
        return empty($search) ? static::query() 
        : static::query()->where('id','like','%'.$search.'%')
        ->orWhere('name','like','%'.$search.'%')
        ->orWhere('display_name','like','%'.$search.'%');
    } 
}
