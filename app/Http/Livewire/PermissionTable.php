<?php

namespace App\Http\Livewire;

use App\Models\Permission;
use Auth;
use DB;
use Livewire\Component;
use Livewire\WithPagination;

class PermissionTable extends Component
{
    use WithPagination;

    public $perPage = 10;
    public $search = '';
    public $orderBy = 'id';
    public $orderAsc = true;
    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $role_count = DB::table('role_user')->where('user_id', Auth::guard('admins')->user()->id)->count();
        $permission = Permission::search($this->search)
            ->orderBy($this->orderBy, $this->orderAsc ? 'asc' : 'desc')
            ->paginate($this->perPage);
        $data = [
            'permission' => $permission,
            'role_count' => $role_count
        ];
        return view('livewire.permission-table', $data);
    }

    public function destroy($id)
    {
        $permission = Permission::find($id);
        if ($permission) {
            $permission->delete();
        }
    }
}
