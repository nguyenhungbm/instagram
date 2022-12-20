<?php

namespace App\Http\Middleware;

use App\Models\Admin;
use Auth;
use Closure;
use DB;
use Illuminate\Http\Request;

class CheckPermissionAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $permission = null)
    {
        //select roles
        $listRole = Admin::find(Auth::guard('admins')->user()->id)
            ->roles()
            ->select('roles.id')
            ->pluck('id')
            ->toArray();
        //select permissions
        $listPermissions = DB::table('roles')
            ->join('permission_role', 'roles.id', 'permission_role.role_id')
            ->join('permissions', 'permissions.id', 'permission_role.permission_id')
            ->whereIn('roles.id', $listRole)
            ->select('permissions.*')
            ->get()
            ->pluck('id')
            ->unique();
        //select name permissions
        $namePermission = DB::table('permissions')->where('name', $permission)->value('id');
        if ($listPermissions->contains($namePermission)) {
            return $next($request);
        }
        return abort(403);
    }

}
