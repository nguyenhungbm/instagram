<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Role;
use DB;
class RoleTable extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $perPage = 10;
    public $search = '';
    public $orderBy = 'id';
    public $orderAsc = true;
    public function render()
    {
        $role=Role::search($this->search) 
                    ->orderBy($this->orderBy, $this->orderAsc ? 'asc' : 'desc')
                    ->paginate($this->perPage);
        $role_count=DB::table('role_user')->where('user_id',\Auth::guard('admins')->user()->id)->count();
         
        $viewData=[
            'role_count'=>$role_count,
            'role'  => $role,
        ];
        return view('livewire.role-table',$viewData);
    }
}
