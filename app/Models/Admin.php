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
        'id','name','email','password','is_admin'
    ];
    public function roles()
    {
        return $this->belongsToMany(Role::class,'role_user','user_id','role_id');
    }
     public function checkPermissionAccess($permissionCheck)
    {
        $roles=\Auth::guard('admins')->user()->role;
        foreach($roles as $list){
            $permission=$list->permissions;
            if($permission->contains('name',$permissionCheck)){
                return true;
            }
        }
        return false;
    }
}
