<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin; 
use Illuminate\Support\Facades\Hash;
use DB;
use App\Models\Role;
use App\Models\Permission;
use Carbon\Carbon;
use PHPUnit\Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Pagination\Paginator;
class AdminController extends Controller
{
     public function index()
    {
        $admin= Admin::simplePaginate(15);
        $role_count=DB::table('role_user')->where('user_id',\Auth::guard('admins')->user()->id)->count();
        $viewData=[
            'admin'     => $admin,
            'role_count'=> $role_count,
            'title'     => 'Quản trị viên',
        ];
        return view('admin.admin.index', $viewData);
    }
    public function create()
    { 
        $role =Role::all();
        $permissionparent=Permission::where('parent_id',null)->get();
        $viewData=[
        'role'  => $role,
        'permissionparent' => $permissionparent,
        'title' => 'Thêm quản trị viên',
    ];
        return view('admin.admin.create', $viewData);
    }
    public function store(Request $request)
    {
            $request->validate([
            'email'     => 'email|required|unique:admins,email',
            'name'      => 'required',
            'password'  => 'min:6',
            'roles'     => 'required'
        ],[
            'email.required' => 'Bạn cần nhập email',
            'email.email'    => 'Email không đúng định dạng',
            'email.unique'   => 'Email đã được đăng ký',
            'name.required'  => 'Bạn cần nhập tên người dùng',
            'password.min'   => 'Mật khẩu cần nhiều hơn 6 kí tự',
            'roles.required' => 'Bạn cần chọn vai trò của người dùng',
        ]);
        try{ 
            DB::beginTransaction();
            $user=Admin::create([
                'name'      => $request->name,
                'email'     => $request->email,
                'password'  => Hash::make($request->password) 
            ]); 
            $user->roles()->attach($request->roles);
            DB::commit();
        return redirect()->route('admin.index');
    }catch(\Exception $e){
        DB::rollBack();
        Log::error('Lỗi :'.$e->getMessage().' tại dòng '.$e->getLine());
        }
    }
    public function edit($id)
    {  
        $admin  = Admin::find($id);
        $role   = Role::all();
        $role_admin = DB::table('role_user')->where('user_id', $id)->select('role_id')->get(); 
        $viewData=[
        'admin'       => $admin,
        'role_admin'  => $role_admin,
        'role'        => $role,
        'title'       => 'Thay đổi người dùng',
    ];
        return view('admin.admin.update', $viewData);
    }
    public function update(Request $request, $id)
    {
       $request->validate([
            'email'=>'email|required',
            'name' =>'required',
        ],[
            'email.required'=>'Bạn cần nhập email',
            'email.email'=>'Email không đúng định dạng',
            'name.required'=>'Bạn cần nhập tên người dùng',
        ]);
        try{ 
            DB::beginTransaction();
            $admin=Admin::find($id);
            if($request->password)
            $admin->update([
                'name' =>$request->name,
                'email'=>$request->email,
                'password' =>Hash::make($request->password) 
            ]); 
            else
            $admin->update([
                'name' =>$request->name,
                'email'=>$request->email,
            ]); 
            $admin->roles()->sync($request->roles);
            DB::commit();
        return redirect()->route('admin.index');
    }catch(\Exception $e){
            DB::rollBack();
            Log::error('Lỗi :'.$e->getMessage().' tại dòng '.$e->getLine());
        }
    }
    public function destroy($id)
    {
        try{ 
            DB::beginTransaction();
            $admin=Admin::find($id)->delete(); 
            $role_admin =DB::table('role_user')->where('user_id', $id)->delete(); 
            DB::commit();
        return redirect()->back();
    }catch(\Exception $e){
            DB::rollBack();
            Log::error('Lỗi :'.$e->getMessage().' tại dòng '.$e->getLine());
        }
    }
}
