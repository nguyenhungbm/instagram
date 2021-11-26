<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Permission;
use Illuminate\Support\Str;
use App\Repositories\Permission\PermissionRepositoryInterface;
class PermissionController extends Controller
{
    private $repository;
    public function __construct(PermissionRepositoryInterface $PermissionRepositoryInterface)
    {
       $this->repository = $PermissionRepositoryInterface;
    }
    public function index()
    {
        $viewData=[
            'title' =>'Quyền hạn',
        ];
        return view('admin.permission.index',$viewData);
    }
    public function create()
    { 
        $permission= $this->repository->getAll();
        $viewData=[
            'permission'  => $permission,
            'title' =>'Thêm quyền hạn',
    ];
        return view('admin.permission.create',$viewData);
    }
    public function store(Request $request)
    {
        // $permission =Permission::where('name',$request->name)->first();
        $request->validate([
            'name'=>'required',
            'display_name'=>'required',
        ],[
            'name.required'=>'Bạn cần nhập tên quyền hạn', 
            'display_name.required'=>'Bạn cần nhập mô tả quyền hạn', 
        ]); 
        if($request->parent_id){
        foreach($request->parent_id as $val){
            $parent_permission =Permission::where('id',$val)->value('name');
            $data['name'] = Str::lower($request->name).'-'.Str::lower($parent_permission);
            $data['display_name'] = $request->display_name;
            $data['parent_id'] = $val;
            $this->repository->create($data);
        }
    }else{
        $data['name'] =  $request->name;
        $data['display_name'] = $request->display_name;
        $data['parent_id'] = 0;
        $this->repository->create($data); 
    }

        return redirect()->route('permission.index');
    }
    public function edit($id)
    { 
        $permission = $this->repository->find($id); 
        $all_permission = $this->repository->getAll();
        $parent_permission=Permission::where('name',$permission->name)->pluck('parent_id')->toArray();
        $viewData = [
            'permission'  =>$permission,
            'all_permission'  =>$all_permission,
            'parent_permission'=>$parent_permission,
            'title' =>'Thay đổi quyền hạn',
        ];
        return view('admin.permission.update',$viewData);
    }
    public function update(Request $request,$id)
    {
        $request->validate([
            'name'=>'required',
            'display_name'=>'required',
        ],[
            'name.required'=>'Bạn cần nhập tên quyền hạn', 
            'display_name.required'=>'Bạn cần nhập mô tả quyền hạn', 
        ]);   
        $this->repository->delete($id);
        if($request->parent_id){
        foreach($request->parent_id as $val){
            $parent_permission = Permission::where('id',$val)->value('name');
            $data['name'] = Str::lower($request->name).'-'.Str::lower($parent_permission);
            $data['display_name'] = $request->display_name;
            $data['parent_id'] = $val;
            $this->repository->create($data); 
        }
    }else{
        $data['name'] =  $request->name;
        $data['display_name'] = $request->display_name;
        $this->repository->create($data); 
    }
        return redirect()->route('permission.index');
    }
    
}
