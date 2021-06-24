<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Permission;
use Illuminate\Support\Str;
class PermissionController extends Controller
{
    public function index()
    {
        $viewData=[
            'title' =>'Quyền hạn',
        ];
        return view('admin.permission.index',$viewData);
    }
    public function create()
    { 
        $permission=Permission::all();
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
        Permission::insert([
                'name' =>Str::lower($request->name).'-'.Str::lower($parent_permission), 
                'display_name' =>$request->display_name, 
                'parent_id' =>$val, 
            ]);  
        }
    }else{
        Permission::insert([
            'name' =>$request->name, 
            'display_name' =>$request->display_name, 
        ]);  
    }
        return redirect()->route('permission.index');
    }
    public function edit($id)
    { 
        $permission=Permission::find($id);
        $all_permission=Permission::all();
        $parent_permission=Permission::where('name',$permission->name)->pluck('parent_id')->toArray();
        $viewData=[
        'permission'  =>$permission,
        'all_permission'  =>$all_permission,
        'parent_permission'=>$parent_permission,
        'title' =>'Thay đổi quyền hạn',
    ];
        return view('admin.permission.update',$viewData);
    }
    public function update(Request $request,$id)
    {
        $permission=Permission::find($id);
        $request->validate([
            'name'=>'required',
            'display_name'=>'required',
        ],[
            'name.required'=>'Bạn cần nhập tên quyền hạn', 
            'display_name.required'=>'Bạn cần nhập mô tả quyền hạn', 
        ]);   
        Permission::where('name',$request->name)->delete();
        if($request->parent_id){
        foreach($request->parent_id as $val){
        $parent_permission =Permission::where('id',$val)->value('name');
        Permission::insert([
            'name' =>Str::lower($request->name).'-'.Str::lower($parent_permission), 
            'display_name' =>$request->display_name, 
            'parent_id' =>$val, 
        ]);  
        }
       
        $permission->save();
    }
        return redirect()->route('permission.index');
    }
    
}
