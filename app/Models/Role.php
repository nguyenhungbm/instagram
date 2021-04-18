<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory; 
    protected $fillable = [
        'name','parent_id','display_name'
    ];
    public function permissions()
    {
        return $this->belongsToMany(Permission::class,'permission_role','role_id','permission_id');
    }
    public function rolesChildren()
    {
        return $this->hasMany(Role::class,'parent_id');
    }
}
