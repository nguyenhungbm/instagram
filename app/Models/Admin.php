<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Admin extends Authenticatable
{
    use HasFactory;
    protected $guarded=[''];
    protected $fillable = [
        'id', 'name', 'email', 'password'
    ];
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_user', 'user_id', 'role_id');
    }
     public function checkPermissionAccess($permissionCheck)
    {
        $roles=\Auth::guard('admins')->user()->role;
        foreach($roles as $list){
            $permission= $list->permissions;
            if($permission->contains('name', $permissionCheck)){
                return true;
            }
        }
        return false;
    }
    public static function search($search){
        return empty($search) ? static::query() 
        : static::query()->where('id', 'like', '%'.$search.'%')
        ->orWhere('name', 'like', '%'.$search.'%')
        ->orWhere('email', 'like', '%'.$search.'%');
    }
}
