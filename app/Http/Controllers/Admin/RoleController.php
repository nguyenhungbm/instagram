<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\Permission;
use DB;
use App\Repositories\Role\RoleRepositoryInterface;
class RoleController extends Controller
{
    private $role,$permission,$repository;
    public function __construct(Role $role,Role $permission,RoleRepositoryInterface $RoleRepositoryInterface)
    {
       $this->role = $role;
       $this->permission = $permission;
       $this->repository = $RoleRepositoryInterface;
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
        $this->repository->find($id);
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
        $data['name'] = $request->name;
        $data['display_name'] = $request->display_name;
        
        $this->repository->create($data);
        $this->role->permissions()->attach($request->permission_id);
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
        $data['name'] = $request->name;
        $data['display_name'] = $request->display_name;
        
        $this->repository->update($id,$data);
        $role->permissions()->sync($request->permission_id);
        return redirect()->route('role.index');
    }
    public function destroy($id)
    { 
        \DB::table('permission_role')->where('role_id',$id)->delete();
        $this->repository->delete($id);
        return redirect()->back();
    }
}
