<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\Permission;
use DB;
class RoleController extends Controller
{
    private $role,$permission;
    public function __construct(Role $role,Permission $permission)
    {
       $this->role=$role;
       $this->permission=$permission;
    }
    public function index()
    {
        $viewData=[
            'title' =>'Phân quyền',
        ];
        return view('admin.role.index',$viewData);
    }
    public function show($id)
    {
       $role =Role::find($id);
       return $role;
    }

    public function create()
    { 
        $role=$this->role->all();
        $permissionParent=$this->permission->where('parent_id', null)->get();
        $viewData=[
            'role'  => $role,
            'permissionParent'  => $permissionParent,
            'title' =>'Thêm quyền hạn',
    ];
        return view('admin.role.create',$viewData);
    }
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'display_name'=>'required',
        ],[
            'name.required'=>'Bạn cần nhập tên quyền hạn', 
            'display_name.required'=>'Bạn cần nhập mô tả quyền hạn', 
        ]); 
        $role=$this->role->create([
            'name' => $request->name,
            'display_name' => $request->display_name,
        ]);
        $role->permissions()->attach($request->permission_id);
        return redirect()->route('role.index');
    }
    public function edit($id)
    { 
        $role=$this->role->find($id);
        $permissionParent=$this->permission->where('parent_id', null)->get();
        $permissionChecked=$role->permissions;
        $viewData=[
        'role'  =>$role,
        'permissionParent'=>$permissionParent,
        'permissionChecked'=>$permissionChecked,
        'title' =>'Thay đổi quyền hạn',
    ];
        return view('admin.role.update',$viewData);
    }
    public function update(Request $request,$id)
    {
        $role=$this->role->find($id);
        $request->validate([
            'name'=>'required',
            'display_name'=>'required',
        ],[
            'name.required'=>'Bạn cần nhập tên quyền hạn', 
            'display_name.required'=>'Bạn cần nhập mô tả quyền hạn', 
        ]);   
        $role->update([
            'name' => $request->name,
            'display_name' => $request->display_name,
        ]);
        $role->permissions()->sync($request->permission_id);
        return redirect()->route('role.index');
    }
    public function destroy($id)
    {
        $role=$this->role->find($id);
        \DB::table('permission_role')->where('role_id',$id)->delete();
        if($role) $role->delete();
        return redirect()->back();
    }
}
